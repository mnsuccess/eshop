<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Wallet;

class UserObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\User  $product
     * @return void
     */
    public function created(User $user)
    {
        Wallet::create([
            'user_id' => $user->id,
            'balance' => 0,
        ]);
    }
}
