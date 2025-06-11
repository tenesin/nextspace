<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('nextspace_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nextspace_id')->constrained()->onDelete('cascade');
            $table->string('day')->nullable(); // e.g. "Monday-Friday"
            $table->string('open_time')->nullable(); // e.g. "08:00"
            $table->string('close_time')->nullable(); // e.g. "18:00"
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('nextspace_hours');
    }
};