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
        Schema::create('reserves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('linguistic_id')->nullable();
            $table->foreign('linguistic_id')->references('id')->on('linguistics')->onDelete('cascade');
            $table->unsignedBigInteger('headquarters_id')->nullable();
            $table->foreign('headquarters_id')->references('id')->on('headquarters')->onDelete('cascade');
            $table->dateTime('dateReserve');
            $table->timestamps();
            $table->unique(['headquarters_id', 'dateReserve']); // Restricción única
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reserves');
    }
};
