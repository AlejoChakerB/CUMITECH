<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->id('id');
            $table->date('delivery_date_card');
            $table->longText('signature_employe_card');
            $table->string('card_item');
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
        Schema::drop('cards');
    }
}
