<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProceduresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedures', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('manual_type');
            $table->string('description');
            $table->string('cups')->key();
            $table->string('rips')->nullable();
            $table->integer('uvr');
            $table->decimal('uvt', 12, 2)->default(0);
            $table->decimal('value', 12, 2)->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['code', 'manual_type']);
            $table->index('cups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('procedures');
    }
}
