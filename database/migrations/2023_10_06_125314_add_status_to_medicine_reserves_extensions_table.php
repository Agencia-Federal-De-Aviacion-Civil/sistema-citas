<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medicine_reserves_extensions', function (Blueprint $table) {
            $table->boolean('status')->default(0)->after('date_reserve_ext');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicine_reserves_extensions', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
