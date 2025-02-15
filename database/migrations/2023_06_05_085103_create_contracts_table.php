<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('salary', 15, 2);
            $table->date('start_date_contract');
            $table->string('disable');
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
        Schema::drop('contracts');
    }
}
