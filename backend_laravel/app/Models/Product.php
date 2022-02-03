<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * Apply discount to the current product
     */
    private function applyDiscount()
    {
        if ($this->is_discountable) {
            if ($this->price >=50 &&  $this->price <= 100) {
                $this->discount = 0.0;
            }

            if ($this->price >= 112 && $this->price <= 115) {
                $this->discount = 0.25;
            }
            
            if ($this->price >= 120) {
                $this->discount = 0.5;
            }
        } else {
            $this->discount = null;
        }
    }

    /**
     * Apply default image to the current image
     */
    private function applyDefaultImage()
    {
        $this->image = "https://picsum.photos/800/600?random=12965";
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
