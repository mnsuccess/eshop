<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\PurchaseRequest;
use App\Http\Requests\API\TopupRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\Order;
use App\Models\Product;

class TransactionController extends Controller
{

    /**
    * Listing of the resource
    * @return \Illuminate\Http\Response
    */
    public function viewTransactions()
    {
        $responseMessage = "User transactions";
        $transaction = Transaction::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return response()->json([
            "success" => true,
            "message" => $responseMessage,
            "data" => TransactionResource::collection($transaction)
        ], 200);
    }

    /**
     *  TopUp amount to the wallet api Endpoint
     */
    public function topup(TopupRequest $request)
    {
        $request->validated();
        $responseMessage = "TopUp Successful";
        $params = $request->only(["amount"]);
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();
        $wallet->balance = $wallet->balance + floatval($params['amount']);
        $wallet->save();
        $this->addTransaction($wallet, 'TopUp', $params['amount'], 'Topup the wallet');
        return response()->json([
            "success" => true,
            "message" => $responseMessage,
        ], 200);
    }
    
    /**
     * Purchase a product api Endpoint
     */
    public function purchase(PurchaseRequest $request)
    {
        $validated = $request->validated();
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
                $this->addTransaction($wallet, 'Purchase', $price, 'Purchased Product Name: '.$product->name.' ID: '.$product->id);
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

    private function addTransaction($wallet, $action, $amount, $note)
    {
        Transaction::create([
            'action' => $action,
            'user_id' => $wallet->user_id,
            'wallet_id' => $wallet->id,
            'amount' => $amount,
            'note' => $note
        ]);
    }
}
