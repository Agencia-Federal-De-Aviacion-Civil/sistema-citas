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
        Schema::create('medicine_reserves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_user_appointment')->nullable();
            $table->foreign('from_user_appointment')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('to_user_headquarters')->nullable();
            $table->foreign('to_user_headquarters')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('medicine_id')->nullable();
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');
            $table->date('dateReserve');
            $table->unsignedBigInteger('medicine_schedule_id')->nullable();
            $table->foreign('medicine_schedule_id')->references('id')->on('medicine_schedules')->onDelete('cascade');
            $table->tinyInteger('status')->default(0); 
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
        Schema::dropIfExists('medicine_reserves');
    }
};
