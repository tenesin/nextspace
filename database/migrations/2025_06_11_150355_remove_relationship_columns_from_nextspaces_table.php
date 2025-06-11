<?php
// database/migrations/xxxx_xx_xx_remove_relationship_columns_from_nextspaces_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('nextspaces', function (Blueprint $table) {
            if (Schema::hasColumn('nextspaces', 'amenities')) $table->dropColumn('amenities');
            if (Schema::hasColumn('nextspaces', 'services')) $table->dropColumn('services');
            if (Schema::hasColumn('nextspaces', 'time_slots')) $table->dropColumn('time_slots');
        });
    }

    public function down()
    {
        Schema::table('nextspaces', function (Blueprint $table) {
            // If you want to restore, define the columns again (optional)
            // $table->string('amenities')->nullable();
            // $table->string('services')->nullable();
            // $table->string('time_slots')->nullable();
        });
    }
};