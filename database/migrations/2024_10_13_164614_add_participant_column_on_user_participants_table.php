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
        Schema::table('user_participants', function (Blueprint $table) {
            $table->string('country_birth_participant')->nullable()->after('genre');
            $table->string('nationality_participant')->nullable()->after('country_birth_participant');
            $table->string('state_birth_participant')->nullable()->after('nationality_participant');
            $table->string('rfc_participant')->unique()->after('age');
            $table->string('rfc_company_participant')->nullable()->after('extension');
            $table->string('name_company_participant')->nullable()->after('rfc_company_participant');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_participants', function (Blueprint $table) {
            $table->dropColumn('country_birth_participant');
            $table->dropColumn('nationality_participant');
            $table->dropColumn('state_birth_participant');
            $table->dropColumn('rfc_participant');
            $table->dropColumn('rfc_company_participant');
            $table->dropColumn('name_company_participant');
        });
    }
};
