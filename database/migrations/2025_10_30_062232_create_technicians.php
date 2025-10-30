<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('technicians', function (Blueprint $table) {
            $table->id();

            // Connect with users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Technician-specific details
            $table->string('employee_code')->unique()->nullable(); // internal code for reference
            $table->string('specialization')->nullable();          // e.g., RO, UV, Pump, etc.
            $table->integer('experience_years')->default(0);
            $table->string('certification_no')->nullable();
            $table->string('service_area')->nullable();            // assigned area or zone
            $table->decimal('rating', 3, 2)->default(0.00);
            $table->boolean('on_duty')->default(0);
            $table->boolean('active')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('technicians');
    }
};
