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
        Schema::create('services', function (Blueprint $table) {
            $table->id();

            // Link to customer & user (owner)
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');

            // If service is for an internal product
            $table->foreignId('product_id')->nullable()->constrained('products')->onDelete('set null');

            // Service details
            $table->string('service_code')->unique();
            $table->enum('source_type', ['internal', 'external'])->default('internal'); // internal = our sold product, external = outsider’s product
            $table->string('external_product_name')->nullable(); // for external case
            $table->string('issue_type')->nullable(); // installation, leakage, maintenance, filter change, etc.
            $table->text('problem_description')->nullable();

            // Service state
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->timestamp('scheduled_date')->nullable();
            $table->timestamp('completed_at')->nullable();

            // Technician assignment
            $table->foreignId('technician_id')->nullable()->constrained('technicians')->onDelete('set null');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
