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
        Schema::create('user_appointment_successes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_appointment_id')->nullable();
            $table->foreign('user_appointment_id')->references('id')->on('user_appointments')->onDelete('cascade');
            $table->unsignedBigInteger('headquarter_id')->nullable();
            $table->foreign('headquarter_id')->references('id')->on('headquarters')->onDelete('cascade');
            $table->date('appointmentDate');
            $table->time('appointmentTime');
            $table->integer('appointments');
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
        Schema::dropIfExists('user_appointment_successes');
    }
};
