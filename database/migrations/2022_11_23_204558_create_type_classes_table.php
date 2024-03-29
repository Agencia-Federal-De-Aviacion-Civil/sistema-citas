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
        Schema::create('type_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_exam_id')->nullable();
            $table->foreign('type_exam_id')->references('id')->on('type_exams')->onDelete('set null');
            $table->unsignedBigInteger('medicine_question_id')->nullable();
            $table->foreign('medicine_question_id')->references('id')->on('medicine_questions')->onDelete('set null');
            $table->string('name');
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
        Schema::dropIfExists('type_classes');
    }
};
