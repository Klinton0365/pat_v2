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
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->decimal('total_amount', 10, 2);
            $table->string('payment_status')->default('pending'); // pending, paid, failed
            $table->string('razorpay_payment_id')->nullable();
            
            $table->decimal('subtotal', 10, 2)->after('total_amount');
            $table->decimal('discount_amount', 10, 2)->default(0)->after('subtotal');
            $table->decimal('coupon_discount', 10, 2)->default(0)->after('discount_amount');
            $table->string('coupon_code')->nullable()->after('coupon_discount');
            $table->decimal('tax_amount', 10, 2)->default(0)->after('coupon_code');
            $table->decimal('shipping_amount', 10, 2)->default(0)->after('tax_amount');

            // Shipping address
            $table->string('shipping_first_name')->nullable()->after('user_id');
            $table->string('shipping_last_name')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('shipping_city')->nullable();
            $table->string('shipping_state')->nullable();
            $table->string('shipping_zip')->nullable();
            $table->string('shipping_country')->nullable();
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
