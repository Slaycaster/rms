<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOtcItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otc_items', function (Blueprint $table) {    
            $table->increments('id');
            $table->string('otc_item_name');
            $table->string('otc_unit_of_measurement');
            $table->integer('otc_item_stock');
            $table->double('otc_item_price');
            $table->integer('branch_id');
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
        Schema::dropIfExists('otc_items');
    }
}
