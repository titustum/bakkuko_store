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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('seller_id')->constrained('users');
            $table->string('name');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->foreignId('category_id')->constrained('categories')->nullable();
            $table->string('image_url')->nullable();
            $table->string('brand')->nullable(); // Added field for the brand
            $table->string('color')->nullable(); // Added field for the color
            $table->string('material')->nullable(); // Added field for the material of the product

            // Specific to clothing and shoes
            $table->string('size')->nullable(); // Added field for size (generic, can be expanded for different types)
            $table->string('fit')->nullable(); // Added field to specify fit (e.g., regular, slim, etc. for clothing)

            // Specific to shoes
            $table->enum('shoe_type', ['sneakers', 'boots', 'sandals', 'formal', 'other'])->nullable(); // Type of shoes

            // Additional fields (optional)
            $table->boolean('is_available')->default(true); // Tracks product availability
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
