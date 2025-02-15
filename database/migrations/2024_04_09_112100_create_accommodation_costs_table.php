<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccommodationCostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation_costs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('year');
            $table->string('month');
            $table->string('cost_center');
            $table->string('service');
            $table->integer('bedrooms');
            $table->integer('beds');
            $table->integer('days_produced');
            $table->decimal('hours_produced', 12, 2);
            $table->decimal('minutes_produced', 12, 2);
            $table->decimal('permanent_overhead', 12, 2);
            $table->decimal('variable_overhead', 12, 2);
            $table->decimal('administrative_twoLevel', 12, 2);
            $table->decimal('logistic_twoLevel', 12, 2);
            $table->decimal('plant_labour', 12, 2);
            $table->decimal('labour', 12, 2);
            $table->decimal('total_cost', 12, 2);
            $table->decimal('daily_cost', 12, 2);
            $table->decimal('bedxday_cost', 12, 2);
            $table->decimal('dayAccommodation_cost', 12, 2);
            $table->decimal('hourAccommodation_cost', 12, 2);
            $table->decimal('bedxhour_cost', 12, 2);
            $table->decimal('bedxminute_cost', 12, 2);
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
        Schema::drop('accommodation_costs');
    }
}
