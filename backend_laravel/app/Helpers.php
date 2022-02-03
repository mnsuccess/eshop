<?php

if (!function_exists('random_image')) {
    function random_image()
    {
        return  'https://picsum.photos/id/'.rand(1, 200).'/800/600?random=12965';
    }
}


if (!function_exists('applyDiscount')) {
    function applyDiscount(\App\Models\Product $product)
    {
        if ($product->is_discountable) {
            if ($product->price >=50 &&  $product->price <= 100) {
                return $product->discount = 0.0;
            }
            if ($product->price >= 112 && $product->price <= 115) {
                return $product->discount = 0.25;
            }
            if ($product->price >= 120) {
                return $product->discount = 0.5;
            }
        } else {
            return $product->discount = null;
        }
    }
}
