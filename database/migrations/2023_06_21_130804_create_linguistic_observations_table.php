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
        Schema::create('linguistic_observations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('linguistic_reserve_id')->nullable();
            $table->foreign('linguistic_reserve_id')->references('id')->on('linguistic_reserves')->onDelete('set null');
            $table->text('observation');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('linguistic_observations');
    }
};
