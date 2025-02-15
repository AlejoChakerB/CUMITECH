<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDistPackagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dist_packages', function (Blueprint $table) {
            $table->id('id');
            $table->string('description');
            $table->decimal('value', 12, 2);
            $table->string('cod_package');
            $table->string('study');
            $table->string('cod_surgical_act');
            $table->integer('id_factu');
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
        Schema::drop('dist_packages');
    }
}
