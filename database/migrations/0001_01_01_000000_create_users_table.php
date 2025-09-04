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
        Schema::create('users', function (Blueprint $table) {
            // Primary Key
            $table->id(); // Auto-increment PK

            // User Info
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();

            // Authentication
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();

            // Social login fields
            $table->string('provider')->nullable()->comment('e.g. google, facebook, github');
            $table->string('provider_id')->nullable();
            $table->text('google_token')->nullable();
            $table->string('google_avatar', 500)->nullable();

            // Laravel default
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
