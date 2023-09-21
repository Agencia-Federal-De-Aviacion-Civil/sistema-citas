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
        Schema::create('medicine_reserves_extensions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medicine_reserve_id')->nullable();
            $table->foreign('medicine_reserve_id')->references('id')->on('medicine_reserves')->onDelete('cascade');
            $table->unsignedBigInteger('type_class_extension_id')->nullable();
            $table->foreign('type_class_extension_id')->references('id')->on('type_classes')->onDelete('cascade');
            $table->unsignedBigInteger('clas_class_extension_id')->nullable();
            $table->foreign('clas_class_extension_id')->references('id')->on('clasification_classes')->onDelete('cascade');
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
        Schema::dropIfExists('medicine_reserves_extensions');
    }
};
