<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurgeriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surgeries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date_surgery');
            $table->string('start_time');
            $table->string('end_time');
            $table->integer('surgeryTime')->nullable();
            $table->string('operating_room');
            $table->integer('cod_surgical_act')->unsigned()->key();
            $table->integer('study_number');
            $table->string('patient');
            $table->integer('id_doctor')->unsigned();
            $table->integer('id_doctor2')->unsigned()->nullable();
            $table->integer('id_anesthesiologist')->unsigned()->nullable();
            $table->integer('cod_helper');
            $table->integer('cod_instrumentator');
            $table->integer('cod_rotator');
            $table->string('category');
            $table->integer('code_contract');
            $table->string('name_contract');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_doctor')->references('code')->on('doctors');
            $table->foreign('id_doctor2')->references('code')->on('doctors');
            $table->foreign('id_anesthesiologist')->references('code')->on('doctors');
            $table->index('cod_surgical_act');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('surgeries');
    }
}
