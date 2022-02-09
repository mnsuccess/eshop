<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\models\Product;
use App\models\Wallet;
use App\models\Order;
use App\Http\Requests\API\PurchaseRequest;

class PurchaseController extends Controller
{

    /**
     * Purchase a product .
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(PurchaseRequest $request)
    {
        $request->validated();
        $params = $request->only(["product_id"]);
        $product = Product::where('id', $params['product_id'])->first();
        if ($product) {
            $price = 0.00;
            if (is_null($product->discount)) {
                $price = $product->price;
            } else {
                $price = $product->product_discounted_price;
            }
            $wallet = Wallet::where('user_id', Auth::user()->id)->first();
            if ($price > $wallet->balance) {
                $responseMessage = "NSF Insufficient funds, TopUp Your Wallet";
                return response()->json([
                    "success" => false,
                    "message" => $responseMessage,
                    "error" => $responseMessage
                ], 422);
            } else {
                $responseMessage = "Purchase Successful";
                $wallet->balance = $wallet->balance - $price;
                $wallet->save();
                //Track the transaction
                addTransaction($wallet, 'Purchase', $price, 'Purchased Product Name: '.$product->name.' ID: '.$product->id);
                //save the order
                Order::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $product->id,
                    'order_ref' => uniqid() ,
                    'total_payable' => $price
                ]);
                return response()->json([
                    "success" => true,
                    "message" => $responseMessage,
                ], 200);
            }
        } else {
            $responseMessage = "Sorry, This product does not exist";
            return response()->json([
                "success" => false,
                "message" => $responseMessage,
                "error" => $responseMessage
            ], 422);
        }
    }
}
