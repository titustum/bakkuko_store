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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users'); // Reference to the user who placed the order
            $table->decimal('total_amount', 10, 2); // Total order amount
            $table->string('delivery_address');
            $table->enum('status', ['pending', 'completed', 'canceled'])->default('pending'); // Order status
            $table->string('payment_intent_id')->nullable(); // Stripe payment intent ID (if using Stripe)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
