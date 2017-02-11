<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtcSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otc_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('otc_item_id');
            $table->integer('unit');
            $table->integer('otc_transaction_id');
            $table->integer('quantity');
            $table->double('price');
            $table->double('additional_charge')->nullable();
            $table->integer('promo_id')->nullable();
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
        Schema::drop('otc_sales');
    }
}
