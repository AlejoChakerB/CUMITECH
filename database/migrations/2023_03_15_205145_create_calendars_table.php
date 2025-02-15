<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('calendars', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('entry_time');
            $table->string('departure_time');
            $table->string('floor');
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
        //Schema::drop('calendars');
    }
}
