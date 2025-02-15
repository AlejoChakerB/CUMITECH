<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagingProductionSuppliesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imaging_production_supplies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service')->nullable();
            $table->decimal('amount_week', 12, 2);
            $table->decimal('quantity_used', 12, 2);
            $table->decimal('unit_price', 12, 2);
            $table->integer('id_article')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_article')->references('id')->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('imaging_production_supplies');
    }
}
