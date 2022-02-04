<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Event;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'is_discountable',
        'discount',
    ];

    /**
     * Bootstrap the model and its traits.
     *
     * @return void
     */

    public static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            Event::dispatch('product.creating', $product);
        });
        static::updating(function ($product) {
            Event::dispatch('product.updating', $product);
        });
    }
    
    /**
     * Get the Price in decimal
     *@return float
     */
    public function getProductPriceAttribute()
    {
        return number_format($this->price, 2);
    }

    /**
     * Get the discounted Price
     *@return float
     */
    public function getProductDiscountedPriceAttribute()
    {
        if (!is_null($this->discount)) {
            return number_format($this->price * (1 - $this->discount / 100), 2);
        } else {
            return null;
        }
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
