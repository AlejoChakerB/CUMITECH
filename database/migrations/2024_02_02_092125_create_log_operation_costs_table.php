<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogOperationCostsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_operation_costs', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('percentage_parti', 12, 2);
            $table->string('time_procedure');
            $table->decimal('doctor_percentage', 12, 2);
            $table->decimal('doctor_fees', 12, 2);
            $table->decimal('doctor2_percentage', 12, 2);
            $table->decimal('doctor2_fees', 12, 2);
            $table->decimal('anest_percentage', 12, 2);
            $table->decimal('anest_fees', 12, 2);
            $table->decimal('value_liquidated', 12, 2);
            $table->decimal('total_liquidated', 12, 2);
            $table->decimal('room_cost', 12, 2);
            $table->decimal('gases', 12, 2);
            $table->string('category')->nullable();
            $table->string('mode')->nullable();
            $table->integer('id_fact');
            $table->integer('cod_package')->nullable();
            $table->decimal('dist_package', 12, 2)->nullable();
            $table->integer('cod_surgical_act')->unsigned();
            $table->integer('code_procedure')->unsigned();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cod_surgical_act')->references('cod_surgical_act')->on('surgeries');
            $table->foreign('code_procedure')->references('id')->on('procedures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('log_operation_costs');
    }
}
