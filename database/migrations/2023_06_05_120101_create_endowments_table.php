<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEndowmentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('endowments', function (Blueprint $table) {
            $table->increments('id');
            $table->json('item');
            $table->date('deliver_date');
            $table->longText('employe_signature');
            $table->string('period');
            $table->integer('contract_id')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('contract_id')->references('id')->on('contracts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('endowments');
    }
}
