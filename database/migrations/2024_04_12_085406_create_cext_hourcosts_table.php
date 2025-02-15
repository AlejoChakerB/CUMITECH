<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCextHourcostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cext_hourcosts', function (Blueprint $table) {
            $table->id('id');
            $table->decimal('permanent_overhead', 12, 2);
            $table->decimal('variable_overhead', 12, 2);
            $table->decimal('administrative_twoLevel', 12, 2);
            $table->decimal('logistic_twoLevel', 12, 2);
            $table->decimal('plant_labour', 12, 2);
            $table->decimal('labour', 12, 2);
            $table->decimal('total_cost', 12, 2)->nullable();
            $table->integer('days_produced');
            $table->decimal('hours_producedxday', 12, 2);
            $table->decimal('hours_producedxmonth', 12, 2);
            $table->decimal('room_valueTotal', 12, 2)->nullable();
            $table->integer('number_room')->nullable();
            $table->decimal('room_value', 12, 2)->nullable();
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
        Schema::drop('cext_hourcosts');
    }
}
