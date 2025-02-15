<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCextDetailsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cext_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('specialty');
            $table->string('procedure')->nullable();
            $table->integer('duration');
            $table->decimal('room_cost', 12, 2)->nullable();
            $table->decimal('medical_fees', 12, 2)->nullable();
            $table->decimal('supplies_cost', 12, 2)->nullable();
            $table->decimal('total_cost', 12, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['specialty', 'procedure']);
            $table->foreign('procedure')->references('code')->on('procedures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cext_details');
    }
}
