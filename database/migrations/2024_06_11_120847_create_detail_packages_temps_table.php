<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPackagesTempsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_packages_temps', function (Blueprint $table) {
            $table->id('id');
            $table->string('description');
            $table->integer('cod_uf');
            $table->string('funcional_unit');
            $table->string('code_service');
            $table->string('description_service');
            $table->integer('id_factu');
            $table->integer('study');
            $table->integer('quanty');
            $table->decimal('recorded_cost', 12, 2);
            $table->decimal('unit_cost', 12, 2);
            $table->string('observation');
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
        Schema::drop('detail_packages_temps');
    }
}
