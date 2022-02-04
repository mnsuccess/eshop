<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Models\Wallet;

class WalletObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Wallet  $product
     * @return void
     */
    public function created(Wallet $wallet)
    {
        Transaction::create([
            'action' => 'TopUp',
            'user_id' => $wallet->user_id,
            'wallet_id' => $wallet->id,
            'amount' => $wallet->balance
        ]);
    }
}
