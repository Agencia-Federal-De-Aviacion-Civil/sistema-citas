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
        Schema::create('user_appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('user_appointment_success_id')->nullable();
            $table->foreign('user_appointment_success_id')->references('id')->on('user_appointment_successes')->onDelete('set null');
            $table->unsignedBigInteger('type_exam_id')->nullable();
            $table->foreign('type_exam_id')->references('id')->on('type_exams')->onDelete('set null');
            $table->unsignedBigInteger('user_payment_document_id')->nullable();
            $table->foreign('user_payment_document_id')->references('id')->on('user_payment_documents')->onDelete('set null');
            $table->string('paymentConcept');
            $table->date('paymentDate');
            $table->boolean('state');
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
        Schema::dropIfExists('user_appointments');
    }
};
