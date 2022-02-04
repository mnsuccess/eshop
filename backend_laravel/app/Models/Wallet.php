<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Event;

class Wallet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'balance'
    ];

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */

    public static function boot()
    {
        parent::boot();
        static::created(function ($wallet) {
            Event::dispatch('wallet.created', $wallet);
        });
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
