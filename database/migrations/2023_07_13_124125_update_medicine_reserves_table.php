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
        Schema::table('medicine_reserves', function (Blueprint $table) {
            $table->dropForeign(['to_user_headquarters']);
            $table->renameColumn('to_user_headquarters', 'headquarter_id');
             $table->foreign('headquarter_id')->references('id')->on('headquarters')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicine_reserves', function (Blueprint $table) {
            $table->renameColumn('headquarter_id', 'to_user_headquarters');
            $table->dropForeign(['headquarter_id']);
        });
    }
};
