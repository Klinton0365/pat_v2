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
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 5, 2)->default(0.00);
            $table->integer('warranty_months')->nullable();
            $table->string('main_image')->nullable();
            $table->json('product_images')->nullable();

            $table->json('colors')->nullable(); // ✅ add this

            $table->integer('stock')->default(0);
            $table->string('sku', 100)->unique()->nullable();
            $table->boolean('is_published')->default(1);
            $table->boolean('publish_home')->default(0);
            $table->boolean('featured')->default(0);
            $table->bigInteger('views')->default(0);
            $table->decimal('rating', 3, 2)->default(0.00);

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
