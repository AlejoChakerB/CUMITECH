<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCextProductionMonthsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cext_production_months', function (Blueprint $table) {
            $table->id('id');
            $table->string('specialty');
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
            $table->decimal('average_months', 12, 2)->nullable();
            $table->integer('duration');
            $table->integer('total_duration')->nullable();
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
        Schema::drop('cext_production_months');
    }
}
