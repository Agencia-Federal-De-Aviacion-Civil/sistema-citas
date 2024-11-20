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
        Schema::create('logs_apis', function (Blueprint $table) {
            $table->id();
            $table->string('curp_logs');
            $table->string('url');
            $table->string('type');
            $table->text('register');
            $table->text('description');
            $table->softDeletes();

            $table->timestamps();
            $table->index('curp_logs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs_apis');
    }
};
