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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            // Relationships
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('set null');

            // Product snapshot (important if product name/price changes later)
            $table->string('product_name'); // store product name at time of order
            $table->string('product_sku')->nullable(); // for inventory tracking
            $table->text('product_image')->nullable(); // store one image reference

            // Pricing details
            $table->integer('quantity')->default(1);
            $table->decimal('price', 10, 2); // unit price
            $table->decimal('discount', 10, 2)->default(0);
            $table->decimal('final_price', 10, 2); // total per item (after discount * qty)
            $table->decimal('tax_amount', 10, 2)->default(0); // per item tax if needed

            // Optional fulfillment tracking
            $table->enum('status', [
                'pending',      // added to order
                'processing',   // picked or packed
                'shipped',      // shipped individually
                'delivered',    // delivered to customer
                'cancelled',    // item cancelled/refunded
            ])->default('pending');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
