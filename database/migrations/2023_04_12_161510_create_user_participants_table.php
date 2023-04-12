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
        Schema::create('user_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('apParental');
            $table->string('apMaternal');
            $table->string('genre');
            $table->string('birth');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id')->references('id')->on('states')->onDelete('set null');
            $table->unsignedBigInteger('municipal_id')->nullable();
            $table->foreign('municipal_id')->references('id')->on('municipals')->onDelete('set null');
            $table->string('age');
            $table->string('street');
            $table->string('nInterior')->nullable();
            $table->string('nExterior')->nullable();
            $table->string('suburb');
            $table->string('postalCode');
            $table->string('federalEntity');
            $table->string('delegation');
            $table->string('mobilePhone');
            $table->string('officePhone')->nullable();
            $table->string('extension')->nullable();
            $table->string('curp');
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
        Schema::dropIfExists('user_participants');
    }
};
