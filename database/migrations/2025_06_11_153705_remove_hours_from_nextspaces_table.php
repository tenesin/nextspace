<?php
// database/migrations/xxxx_xx_xx_remove_hours_from_nextspaces_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('nextspaces', function (Blueprint $table) {
            $table->dropColumn('hours');
        });
    }

    public function down()
    {
        Schema::table('nextspaces', function (Blueprint $table) {
            $table->string('hours')->nullable();
        });
    }
};