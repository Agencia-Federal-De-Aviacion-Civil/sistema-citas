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
        Schema::create('medicine_revaluation_renovations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('medicine_revaluation_id')->nullable();
            $table->foreign('medicine_revaluation_id')->references('id')->on('medicine_revaluations')->onDelete('cascade');
            $table->unsignedBigInteger('type_class_id')->nullable();
            $table->foreign('type_class_id')->references('id')->on('type_classes')->onDelete('cascade');
            $table->unsignedBigInteger('clasification_class_id')->nullable();
            $table->foreign('clasification_class_id')->references('id')->on('clasification_classes')->onDelete('cascade');
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
        Schema::dropIfExists('medicine_revaluation_renovations');
    }
};
