<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStandAssistancesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stand_assistances', function (Blueprint $table) {
            $table->id('id');
            $table->string('stand');
            $table->string('state');
            $table->string('approved_date');
            $table->integer('id_user_employees')->unsigned();
            $table->integer('id_presenter')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_user_employees')->references('id')->on('user_employees');
            $table->foreign('id_presenter')->references('id')->on('presenters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('stand_assistances');
    }
}
