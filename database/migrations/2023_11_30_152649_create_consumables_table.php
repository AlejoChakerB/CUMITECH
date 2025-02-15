<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsumablesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consumables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consumable_quantity');
            $table->integer('package_quantity');
            $table->integer('level');
            $table->decimal('unit_price', 12, 2);
            $table->string('id_article');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('id_article')->references('item_code')->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('consumables');
    }
}
