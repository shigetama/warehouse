<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipplans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('shipplan_id');
            $table->date('ship_date');
            $table->unsignedInteger('warehouse_id');
            $table->unsignedInteger('item_id');
            $table->integer('item_num');
            $table->timestamps();

            $table
              ->foreign('warehouse_id')
              ->references('id')
              ->on('warehouses')
              ->onDelete('cascade');
            $table
              ->foreign('item_id')
              ->references('id')
              ->on('items')
              ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipplans');
    }
}
