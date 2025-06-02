<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nextspaces', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('hours')->nullable();
            $table->decimal('rating', 2, 1)->nullable();
            $table->integer('reviews_count')->nullable();
            $table->json('amenities')->nullable();
            $table->json('services')->nullable();
            $table->json('time_slots')->nullable();
            $table->decimal('base_price', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nextspaces');
    }
};
