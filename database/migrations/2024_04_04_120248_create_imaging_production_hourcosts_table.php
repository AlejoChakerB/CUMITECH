<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagingProductionHourcostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imaging_production_hourcosts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service');
            $table->decimal('permanent_overhead', 12, 2);
            $table->decimal('variable_overhead', 12, 2);
            $table->decimal('administrative_twoLevel', 12, 2);
            $table->decimal('logistic_twoLevel', 12, 2);
            $table->decimal('plant_labour', 12, 2);
            $table->decimal('supplies', 12, 2);
            $table->decimal('total_cost', 12, 2);
            $table->decimal('employee', 12, 2);
            $table->decimal('hour_value', 12, 2);
            $table->integer('number_rooms');
            $table->decimal('hour_value_room', 12, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('imaging_production_hourcosts');
    }
}
