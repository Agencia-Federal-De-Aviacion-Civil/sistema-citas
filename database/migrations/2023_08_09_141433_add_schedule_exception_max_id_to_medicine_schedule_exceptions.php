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
        Schema::table('medicine_schedule_exceptions', function (Blueprint $table) {
            $table->unsignedBigInteger('schedule_exception_max_id')->nullable()->after('type_exam_id');
            $table->foreign('schedule_exception_max_id')->references('id')->on('medicine_schedule_exception_max_exceptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('medicine_schedule_exceptions', function (Blueprint $table) {
            $table->dropColumn('schedule_exception_max_id');
        });
    }
};
