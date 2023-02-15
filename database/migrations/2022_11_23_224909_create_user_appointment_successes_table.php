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
            $table->unsignedBigInteger('from_user_appointment')->nullable();
            $table->foreign('from_user_appointment')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('to_user_headquarters')->nullable();
            $table->foreign('to_user_headquarters')->references('id')->on('users')->onDelete('cascade');
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
