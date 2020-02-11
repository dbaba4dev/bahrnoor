<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->integer('customer_id');
            $table->bigInteger('bags_sold');
            $table->bigInteger('damages')->default(0);
            $table->float('amount_paid');
            $table->float('amount_exp');  //Amount Expected
            $table->float('balance');  //Amount remains
            $table->string('description')->nullable();  //Amount remains
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bags');
    }
}
