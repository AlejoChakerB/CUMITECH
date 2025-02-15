<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodBankMonthsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_bank_months', function (Blueprint $table) {
            $table->id('id');
            $table->string('period');
            $table->integer('january')->nullable();
            $table->decimal('january_value', 12, 2)->nullable();
            $table->integer('february')->nullable();
            $table->decimal('february_value', 12, 2)->nullable();
            $table->integer('march')->nullable();
            $table->decimal('march_value', 12, 2)->nullable();
            $table->integer('april')->nullable();
            $table->decimal('april_value', 12, 2)->nullable();
            $table->integer('may')->nullable();
            $table->decimal('may_value', 12, 2)->nullable();
            $table->integer('june')->nullable();
            $table->decimal('june_value', 12, 2)->nullable();
            $table->integer('july')->nullable();
            $table->decimal('july_value', 12, 2)->nullable();
            $table->integer('august')->nullable();
            $table->decimal('august_value', 12, 2)->nullable();
            $table->integer('september')->nullable();
            $table->decimal('september_value', 12, 2)->nullable();
            $table->integer('october')->nullable();
            $table->decimal('october_value', 12, 2)->nullable();
            $table->integer('november')->nullable();
            $table->decimal('november_value', 12, 2)->nullable();
            $table->integer('december')->nullable();
            $table->decimal('december_value', 12, 2)->nullable();
            $table->decimal('average_months', 12, 2)->nullable();
            $table->decimal('unit_price', 12, 2)->nullable();
            $table->decimal('total_months', 12, 2)->nullable();
            $table->decimal('total_value', 12, 2)->nullable();
            $table->decimal('average_value', 12, 2)->nullable();
            $table->decimal('participe', 12, 2)->nullable();
            $table->decimal('honorary_bs', 12, 2)->nullable();
            $table->decimal('log', 12, 2)->nullable();
            $table->decimal('admin', 12, 2)->nullable();
            $table->decimal('total_cost', 12, 2)->nullable();
            $table->string('cups');
            $table->string('observation')->nullable();
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
        Schema::drop('blood_bank_months');
    }
}
