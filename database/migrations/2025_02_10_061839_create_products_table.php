<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Suppliers;
use App\Models\Category;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Suppliers::class);
            $table->foreignIdFor(Category::class);
            $table->string('product_name');
            $table->integer('quantity');
            $table->string('price');
            $table->integer('units_in_stock');
            $table->integer('units_on_order');
            $table->integer('reorder_level');
            $table->integer('discontinued');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
