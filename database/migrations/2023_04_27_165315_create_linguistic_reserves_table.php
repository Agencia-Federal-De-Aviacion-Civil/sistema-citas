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
        Schema::create('linguistic_reserves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user_appointment')->nullable();
            $table->foreign('from_user_appointment')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('to_user_headquarters')->nullable();
            $table->foreign('to_user_headquarters')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('linguistic_id')->nullable();
            $table->foreign('linguistic_id')->references('id')->on('linguistics')->onDelete('cascade');
            $table->date('date_reserve');
            $table->unsignedBigInteger('schedule_id')->nullable();
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('cascade');
            $table->tinyInteger('status')->default(0); //cero es pendiente ok amor?
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
        Schema::dropIfExists('linguistic_reserves');
    }
};
