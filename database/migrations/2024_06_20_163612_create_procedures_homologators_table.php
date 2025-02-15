<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProceduresHomologatorsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedures_homologators', function (Blueprint $table) {
            $table->id('id');
            $table->string('cups');
            $table->string('cups_soat');
            $table->string('description_soat');
            $table->string('cups_iss');
            $table->string('description_iss');
            $table->string('service_reps');
            $table->string('category');
            $table->string('group');
            $table->string('subgroup');
            $table->integer('uvr');
            $table->decimal('honorary_iss', 12, 2);
            $table->decimal('anest_iss', 12, 2);
            $table->decimal('helper_iss', 12, 2);
            $table->decimal('room_iss', 12, 2);
            $table->decimal('materials_iss', 12, 2);
            $table->decimal('value_iss', 12, 2);
            $table->integer('uvt');
            $table->decimal('honorary_soat', 12, 2);
            $table->decimal('anest_soat', 12, 2);
            $table->decimal('helper_soat', 12, 2);
            $table->decimal('room_soat', 12, 2);
            $table->decimal('materials_soat', 12, 2);
            $table->decimal('value_soat', 12, 2);
            $table->string('observation');
            $table->timestamps();
            $table->softDeletes();

            $table->index('cups');
            $table->index('cups_soat');
            $table->index('description_soat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('procedures_homologators');
    }
}
