<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagingProductionCupsxitemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imaging_production_cupsxitems', function (Blueprint $table) {
            $table->id('id');
            $table->string('service');
            $table->string('category');
            $table->json('items');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['service', 'category']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('imaging_production_cupsxitems');
    }
}
