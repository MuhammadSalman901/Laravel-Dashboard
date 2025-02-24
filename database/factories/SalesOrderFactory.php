<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customers;
use App\Models\Shippers;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SalesOrder>
 */
class SalesOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customers_id' => Customers::factory(),
            'user_id' => User::factory(),
            'shippers_id' => Shippers::factory(),
            'order_date' => fake()->date('Y-m-d','now'),
            'required_date' => fake()->date('Y-m-d','now'),
            'shipped_date' => fake()->date('Y-m-d','now'),
            'ship_name' => fake()->name(),
            'ship_address' => fake()->address(),
            'ship_city' => fake()->city(),
            'ship_country' => fake()->country(),
        ];
    }
}
