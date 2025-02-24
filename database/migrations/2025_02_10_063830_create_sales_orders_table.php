<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Customers;
use App\Models\User;
use App\Models\Shippers;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customers::class);
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Shippers::class);
            $table->date('order_date');
            $table->date('required_date');
            $table->date('shipped_date');
            $table->string('ship_name');
            $table->text('ship_address');
            $table->string('ship_city');
            $table->string('ship_country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
