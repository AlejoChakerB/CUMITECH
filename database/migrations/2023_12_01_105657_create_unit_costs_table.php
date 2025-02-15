<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitCostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_costs', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('room_cost', 12, 2);
            $table->decimal('gas', 12, 2);
            $table->decimal('total_value', 12, 2)->nullable();
            $table->decimal('consumables', 12, 2);
            $table->decimal('basket', 12, 2);
            $table->decimal('rented', 12, 2)->nullable();
            $table->decimal('medical_fees', 12, 2);
            $table->decimal('medical_fees2', 12, 2)->nullable();
            $table->decimal('anest_fees', 12, 2)->nullable();
            $table->decimal('dist_pack', 12, 2)->nullable();
            $table->integer('cod_surgical_act')->unsigned();
            $table->string('category')->nullable();
            $table->string('mode')->nullable();
            $table->string('observation')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cod_surgical_act')->references('cod_surgical_act')->on('surgeries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('unit_costs');
    }
}
