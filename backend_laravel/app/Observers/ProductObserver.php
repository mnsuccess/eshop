<?php

namespace App\Observers;

use App\Models\Product;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function creating(Product $product)
    {
        //apply discount
        $product->discount = applyDiscount($product);
        //default image
        if (is_null($product->image)) {
            $product->image =  random_image();
        }
    }

    /**
     * Handle the Product "updated" event.
     *
     * @param  \App\Models\Product  $product
     * @return void
     */
    public function updating(Product $product)
    {
        //apply discount
        $product->discount = applyDiscount($product);
    }
}
