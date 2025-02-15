<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagingProductionMonthsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imaging_production_months', function (Blueprint $table) {
            $table->increments('id');
            $table->string('service');
            $table->string('period');
            $table->decimal('january', 12, 2)->nullable();
            $table->decimal('february', 12, 2)->nullable();
            $table->decimal('march', 12, 2)->nullable();
            $table->decimal('april', 12, 2)->nullable();
            $table->decimal('may', 12, 2)->nullable();
            $table->decimal('june', 12, 2)->nullable();
            $table->decimal('july', 12, 2)->nullable();
            $table->decimal('august', 12, 2)->nullable();
            $table->decimal('september', 12, 2)->nullable();
            $table->decimal('october', 12, 2)->nullable();
            $table->decimal('november', 12, 2)->nullable();
            $table->decimal('december', 12, 2)->nullable();
            $table->decimal('average_months', 12, 2);
            $table->integer('duration')->nullable();
            $table->integer('total_duration')->nullable();
            $table->integer('cups')->unsigned();
            $table->string('observation')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cups')->references('id')->on('procedures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('imaging_production_months');
    }
}
