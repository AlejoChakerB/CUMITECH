<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvimaRegistrationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invima_registrations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('generic_name');
            $table->string('tradename');
            $table->string('health_register');
            $table->string('state_invima');
            $table->string('validity_registration');
            $table->string('laboratory_manufacturer');
            $table->string('pharmaceutical_form');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('invima_registrations');
    }
}
