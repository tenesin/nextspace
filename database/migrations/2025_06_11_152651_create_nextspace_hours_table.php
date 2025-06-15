<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNextspaceHoursTable extends Migration
{
    public function up()
    {
        Schema::create('nextspace_hours', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nextspace_id');
            $table->enum('day_type', ['mon-fri', 'sat-sun']);
            $table->string('open_time')->default('08:00');
            $table->string('close_time')->default('20:00');
            $table->timestamps();

            $table->foreign('nextspace_id')->references('id')->on('nextspaces')->onDelete('cascade');
            $table->unique(['nextspace_id', 'day_type']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('nextspace_hours');
    }
}