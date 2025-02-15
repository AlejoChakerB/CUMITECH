<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipleSurgeriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiple_surgeries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mdate_surgery');
            $table->string('mstart_time');
            $table->string('mend_time');
            $table->integer('msurgery_time')->nullable();
            $table->string('moperating_room');
            $table->integer('mcod_surgical_act')->unsigned()->key();
            $table->integer('mstudy_number');
            $table->string('patient');
            $table->integer('id_doctor')->unsigned();
            $table->integer('id_doctor2')->unsigned()->nullable();
            $table->integer('id_anesth')->unsigned()->nullable();
            $table->integer('cod_helper');
            $table->integer('cod_instrumentator');
            $table->integer('cod_rotator');
            $table->string('category');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_doctor')->references('code')->on('doctors');
            $table->foreign('id_doctor2')->references('code')->on('doctors');
            $table->foreign('id_anesth')->references('code')->on('doctors');
            $table->index('mcod_surgical_act');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('multiple_surgeries');
    }
}
