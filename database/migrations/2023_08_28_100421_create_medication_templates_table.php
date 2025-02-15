<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicationTemplatesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medication_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('template_name');
            $table->string('concentrationt');
            $table->string('presentationt');
            $table->integer('received_amountt');
            $table->integer('samplet');
            $table->integer('invima_registrations_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('invima_registrations_id')->references('id')->on('invima_registrations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('medication_templates');
    }
}
