<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\Controller;
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
        $params = $request->only(["amount"]);
        $wallet = Wallet::where('user_id', Auth::user()->id)->first();
        $wallet->balance = $wallet->balance + floatval($params['amount']);
        $wallet->save();
        addTransaction($wallet, 'TopUp', $params['amount'], 'TopUp the wallet');
        return $this->success("TopUp Successful");
    }
}
