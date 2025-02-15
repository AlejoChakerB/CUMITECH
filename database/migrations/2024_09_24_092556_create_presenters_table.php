<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePresentersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presenters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stand');
            $table->longText('qr_code');
            $table->integer('id_users_employees')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_users_employees')->references('id')->on('user_employees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('presenters');
    }
}
