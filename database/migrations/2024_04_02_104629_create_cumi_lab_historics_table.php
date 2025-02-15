<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCumiLabHistoricsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cumi_lab_historics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('period');
            $table->decimal('january', 12, 2);
            $table->decimal('february', 12, 2);
            $table->decimal('march', 12, 2);
            $table->decimal('april', 12, 2);
            $table->decimal('may', 12, 2);
            $table->decimal('june', 12, 2);
            $table->decimal('july', 12, 2);
            $table->decimal('august', 12, 2);
            $table->decimal('september', 12, 2);
            $table->decimal('october', 12, 2);
            $table->decimal('november', 12, 2);
            $table->decimal('december', 12, 2);
            $table->decimal('total_months', 12, 2);
            $table->decimal('average_months', 12, 2);
            $table->decimal('cumilab_rate', 12, 2);
            $table->decimal('mutual_rate', 12, 2);
            $table->decimal('pxq', 12, 2);
            $table->decimal('part_percentage', 12, 2);
            $table->decimal('adminlog', 12, 2);
            $table->decimal('adminlog_percentage', 12, 2);
            $table->decimal('cd', 12, 2);
            $table->decimal('cd_percentage', 12, 2);
            $table->decimal('total', 12, 2);
            $table->string('cups');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cups')->references('code')->on('procedures');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cumi_lab_historics');
    }
}
