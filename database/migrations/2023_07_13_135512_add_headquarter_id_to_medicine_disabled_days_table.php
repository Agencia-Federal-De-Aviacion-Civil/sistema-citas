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
            $table->unsignedBigInteger('headquarter_id')->nullable()->after('id');
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
        Schema::table('medicine_disabled_days', function (Blueprint $table) {
            $table->dropColumn('headquarter_id');
        });
    }
};
