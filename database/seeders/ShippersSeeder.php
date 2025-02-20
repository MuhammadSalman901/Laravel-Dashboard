<?php

namespace Database\Seeders;

use App\Models\Shippers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Shippers::factory(10)->create();
    }
}
