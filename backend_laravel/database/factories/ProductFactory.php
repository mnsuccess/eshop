<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->city,
            'description' => $this->faker->paragraph($nb=1),
            'price' => $this->faker->unique()->numberBetween(50, 500),
            'image' => 'https://picsum.photos/id/'.$this->faker->unique()->numberBetween(1, 500).'/800/600?random=12965',
            'is_discountable'=> random_int(0, 1),
        ];
    }
}
