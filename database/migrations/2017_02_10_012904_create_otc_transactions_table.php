<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtcTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otc_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('customer');
            $table->string('customer_contact')->nullable();
            $table->string('customer_address')->nullable();
            $table->integer('branch_id');
            $table->integer('promo_id')->nullable();
            $table->integer('user_id');
            $table->double('price')->nullable();
            $table->integer('stylist_id');
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
        Schema::drop('otc_transactions');
    }
}
