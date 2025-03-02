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
        Schema::table('attendance', function (Blueprint $table) {
            $table->dropColumn('check_in_gps');
            $table->dropColumn('check_out_gps');

            $table->decimal('check_in_latitude', 10, 8)->after('check_in_stop_id');
            $table->decimal('check_in_longitude', 11, 8)->after('check_in_latitude');
            $table->decimal('check_out_latitude', 10, 8)->nullable()->after('check_out_stop_id');
            $table->decimal('check_out_longitude', 11, 8)->nullable()->after('check_out_latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendance', function (Blueprint $table) {
            $table->dropColumn('check_in_latitude');
            $table->dropColumn('check_in_longitude');
            $table->dropColumn('check_out_latitude');
            $table->dropColumn('check_out_longitude');

            $table->geometry('check_in_gps')->after('check_in_stop_id');
            $table->geometry('check_out_gps')->nullable()->after('check_out_stop_id');
        });
    }
};
