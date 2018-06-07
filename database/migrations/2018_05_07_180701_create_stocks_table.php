<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('warehouse_id');
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('item_num');
            $table->unsignedInteger('provision_num')->default('0');
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
        Schema::dropIfExists('stocks');
    }
}
