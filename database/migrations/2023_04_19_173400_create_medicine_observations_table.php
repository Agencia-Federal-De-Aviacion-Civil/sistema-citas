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
        Schema::create('medicine_observations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medicine_reserve_id')->nullable();
            $table->foreign('medicine_reserve_id')->references('id')->on('medicine_reserves')->onDelete('set null');
            $table->text('observation');
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
        Schema::dropIfExists('medicine_observations');
    }
};
