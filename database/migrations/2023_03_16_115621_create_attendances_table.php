<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->increments('id');
            $table->date('workday');
            $table->string('aentry_time');
            $table->string('adeparture_time')->nullable();
            $table->integer('employe_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('employe_id')->references('id')->on('employes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::drop('attendances');
    }
}
