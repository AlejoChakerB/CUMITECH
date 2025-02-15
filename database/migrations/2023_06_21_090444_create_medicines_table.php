<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->increments('id');
            $table->date('admission_date');
            $table->integer('act_number');
            $table->string('generic_name');
            $table->string('tradename');
            $table->string('concentration');
            $table->string('pharmaceutical_form');
            $table->string('presentation');
            $table->date('expiration_date');
            $table->string('lot_number');
            $table->integer('invima_registrations_id')->unsigned();
            $table->date('registration_validity');
            $table->string('observation_record');
            $table->string('manufacturer_laboratory');
            $table->string('supplier');
            $table->string('invoice_number');
            $table->integer('received_amount');
            $table->string('purchase_order');
            $table->string('entered_by');
            $table->integer('sample');
            $table->string('lettering')->nullable();
            $table->string('packing')->nullable();
            $table->string('laminate')->nullable();
            $table->string('closing')->nullable();
            $table->string('all')->nullable();
            $table->string('liquids')->nullable();
            $table->string('semisolid')->nullable();
            $table->string('dust')->nullable();
            $table->string('tablet')->nullable();
            $table->string('capsule')->nullable();
            $table->string('arrival_temperature');
            $table->string('observations')->nullable();
            $table->string('state');
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
        Schema::drop('medicines');
    }
}
