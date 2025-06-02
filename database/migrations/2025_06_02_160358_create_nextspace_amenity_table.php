<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('nextspace_amenity', function (Blueprint $table) {
            $table->foreignId('nextspace_id')->constrained()->onDelete('cascade');
            $table->foreignId('amenity_id')->constrained()->onDelete('cascade');
            $table->primary(['nextspace_id', 'amenity_id']); // Composite primary key
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nextspace_amenity');
    }
};
