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
        Schema::create('writers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 45);
            $table->string('email', 45)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('address', 45);
            $table->string('phone_number', 15)->unique();
            $table->string('bio');
            $table->foreignId('admin_id')->constrained()->noActionOnDelete()->cascadeOnUpdate();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('writers');
    }
};
