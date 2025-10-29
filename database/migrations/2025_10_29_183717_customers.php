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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            // Foreign key to users table
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            // Customer Specific Info
            $table->string('customer_code')->unique()->comment('Unique generated code');
            $table->enum('customer_type', ['individual', 'business'])->default('individual');
            $table->string('company_name')->nullable();
            $table->string('gst_number')->nullable(); // If needed (India-specific)
            $table->string('status')->default('active'); // active, inactive, blocked

            // Additional important details
            $table->string('referral_code')->nullable();
            $table->decimal('credit_limit', 10, 2)->default(0);
            $table->timestamp('joined_at')->nullable();

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
