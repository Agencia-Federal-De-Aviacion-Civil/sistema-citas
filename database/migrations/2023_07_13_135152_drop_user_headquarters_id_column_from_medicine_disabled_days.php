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
        Schema::table('medicine_disabled_days', function (Blueprint $table) {
            $table->dropForeign(['user_headquarters_id']);
            $table->dropColumn('user_headquarters_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicine_disabled_days', function (Blueprint $table) {
            $table->unsignedBigInteger('user_headquarters_id')->nullable();
            $table->foreign('user_headquarters_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
