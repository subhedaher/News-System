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
        Schema::create('status_articles', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['approved', 'wating', 'rejected', 'hard rejected']);
            $table->string('notes');
            $table->foreignId('article_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('admin_id')->nullable()->constrained()->noActionOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_articles');
    }
};
