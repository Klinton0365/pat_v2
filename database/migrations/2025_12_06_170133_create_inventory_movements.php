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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('batch_id')->nullable()->constrained('inventory_batches')->onDelete('set null');

            $table->enum('type', ['in', 'out', 'adjustment', 'damage', 'return']);
            $table->integer('quantity');
            $table->decimal('cost_price', 10, 2)->nullable(); // required for valuation

            $table->string('reference_type')->nullable(); // order, purchase, manual
            $table->string('reference_id')->nullable();   // order_id, etc
            $table->text('notes')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};
