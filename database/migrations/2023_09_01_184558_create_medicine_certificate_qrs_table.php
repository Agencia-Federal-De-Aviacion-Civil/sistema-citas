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
        Schema::create('medicine_certificate_qrs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medicine_reserves_id')->nullable();
            $table->foreign('medicine_reserves_id')->references('id')->on('medicine_reserves')->onDelete('cascade');
            $table->date('date_expire');
            $table->string('medical_name');
            $table->string('evaluation_result');
            $table->unsignedBigInteger('document_license_id')->nullable();
            $table->foreign('document_license_id')->references('id')->on('documents')->onDelete('cascade');
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
        Schema::dropIfExists('medicine_certificate_qrs');
    }
};
