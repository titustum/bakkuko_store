<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->foreignId('cart_id')->constrained()->onDelete('cascade'); // Foreign key to the carts table
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key to the products table
            $table->integer('quantity')->default(1); // Quantity of the product in the cart
            $table->decimal('price_at_time_of_addition', 10, 2); // Price of the product when it was added to the cart
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
