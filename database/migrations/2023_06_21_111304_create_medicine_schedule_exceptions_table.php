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
        Schema::create('medicine_schedule_exceptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medicine_schedule_id')->nullable();
            $table->foreign('medicine_schedule_id')->references('id')->on('medicine_schedules')->onDelete('cascade');
            $table->unsignedBigInteger('type_exam_id')->nullable();
            $table->foreign('type_exam_id')->references('id')->on('type_exams')->onDelete('cascade');
            $table->integer('max_schedules_exception')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_schedule_exceptions');
    }
};
