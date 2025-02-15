<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code')->unsigned()->key();
            $table->string('dni');
            $table->string('full_name');
            $table->string('category_doctor');
            $table->string('specialty');
            $table->string('payment_type')->nullable();
            $table->string('payment')->nullable();
            $table->integer('id_fees')->unsigned()->nullable();
            $table->integer('id_fees2')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_fees')->references('honorary_code')->on('medical_fees');
            $table->foreign('id_fees2')->references('honorary_code')->on('medical_fees');
            $table->index('code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('doctors');
    }
}
