<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recplans', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('recplan_id');
            $table->date('rec_date');
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
        Schema::dropIfExists('recplans');
    }
}
