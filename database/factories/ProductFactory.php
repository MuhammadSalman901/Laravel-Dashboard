<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Suppliers;
use App\Models\Category;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'suppliers_id' => Suppliers::factory(),
            'category_id' => Category::factory(),
            'product_name' => fake()->word(),
            'quantity' => fake()->numberBetween(0,50),
            'price' => fake()->numerify('$##.##'),
            'units_in_stock' => fake()->numberBetween(0,50),
            'units_on_order' => fake()->numberBetween(0,25),
            'reorder_level' => fake()->numberBetween(0,50),
            'discontinued' => fake()->numberBetween(0,1)
        ];
    }
}
