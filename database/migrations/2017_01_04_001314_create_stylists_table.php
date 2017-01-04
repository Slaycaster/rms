<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylists', function (Blueprint $table) {
            $table->increments('id');
            $table->string('stylist_last_name');
            $table->string('stylist_first_name');
            $table->string('stylist_middle_name')->nullable();
            $table->string('stylist_address');
            $table->string('stylist_contact_no');
            $table->string('stylist_email')->nullable();
            $table->date('date_hired');
            $table->string('branch_id');
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
        Schema::dropIfExists('stylists');
    }
}
