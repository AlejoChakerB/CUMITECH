<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoatGroupsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soat_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group');
            $table->decimal('surgeon', 12, 2);
            $table->decimal('anesthed', 12, 2);
            $table->decimal('assistant', 12, 2);
            $table->decimal('room', 12, 2);
            $table->decimal('materials', 12, 2);
            $table->decimal('total', 12, 2);
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
        Schema::drop('soat_groups');
    }
}
