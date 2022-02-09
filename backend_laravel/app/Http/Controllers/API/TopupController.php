<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\TopupRequest;
use App\Models\Wallet;

class TopupController extends Controller
{
    /**
    * TopUp an amount in the wallet
    *
    * @return \Illuminate\Http\Response
    */
    public function __invoke(TopupRequest $request)
    {
        $request->validated();
        $responseMessage = "TopUp Successful";
        $params = $request->only(["amount"]);
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();
        $wallet->balance = $wallet->balance + floatval($params['amount']);
        $wallet->save();
        addTransaction($wallet, 'TopUp', $params['amount'], 'Topup the wallet');
        return response()->json([
            "success" => true,
            "message" => $responseMessage,
        ], 200);
    }
}
