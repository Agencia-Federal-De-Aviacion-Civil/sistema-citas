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
        Schema::create('user_renovations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_appointment_id')->nullable();
            $table->foreign('user_appointment_id')->references('id')->on('user_appointments')->onDelete('set null');
            $table->unsignedBigInteger('type_class_id')->nullable();
            $table->foreign('type_class_id')->references('id')->on('type_classes')->onDelete('set null');
            $table->unsignedBigInteger('clasification_class_id')->nullable();
            $table->foreign('clasification_class_id')->references('id')->on('clasification_classes')->onDelete('set null');
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
        Schema::dropIfExists('user_renovations');
    }
};
