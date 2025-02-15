<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentedEquipmentsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rented_equipments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('art_code');
            $table->string('description');
            $table->decimal('value', 12, 2);
            $table->string('specialty');
            $table->string('procedure_id');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('procedure_id')->references('cups')->on('procedures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('rented_equipments');
    }
}
