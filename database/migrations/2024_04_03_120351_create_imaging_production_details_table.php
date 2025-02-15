<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagingProductionDetailsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imaging_production_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service');
            $table->string('category')->nullable();
            $table->string('category_sedation')->nullable();
            $table->integer('duration');
            $table->decimal('room_cost', 12, 2)->nullable();
            $table->decimal('transcriber_cost', 12, 2)->nullable();
            $table->decimal('doctor_cost', 12, 2)->nullable();
            $table->decimal('supplies_cost', 12, 2)->nullable();
            $table->decimal('contrast', 12, 2)->nullable();
            $table->decimal('sedation', 12, 2)->nullable();
            $table->decimal('total_cost', 12, 2)->nullable();
            $table->string('cups');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cups')->references('code')->on('procedures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('imaging_production_details');
    }
}
