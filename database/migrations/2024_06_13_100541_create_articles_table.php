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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 45);
            $table->string('short_info');
            $table->text('info');
            $table->string('image');
            $table->enum('status', ['approved', 'wating', 'rejected', 'hard rejected']);
            $table->integer('views')->default(0);
            $table->timestamp('date_publish')->nullable();
            $table->foreignId('writer_id')->constrained()->noActionOnDelete()->cascadeOnUpdate();
            $table->foreignId('category_id')->constrained()->restrictOnDelete()->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
