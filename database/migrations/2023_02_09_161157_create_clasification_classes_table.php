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
        Schema::create('clasification_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type_class_id')->nullable();
            $table->foreign('type_class_id')->references('id')->on('type_classes')->onDelete('set null');
            $table->string('name');
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
        Schema::dropIfExists('clasification_classes');
    }
};
