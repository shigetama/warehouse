<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecconfirmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recconfirms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('rec_plan_id');
            $table->unsignedInteger('item_id');
            $table->unsignedInteger('item_num');
            $table->unsignedInteger('warehouse_id');
            $table->timestamps();

            $table
              ->foreign('warehouse_id')
              ->references('id')
              ->on('warehouses')
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
        Schema::dropIfExists('recconfirms');
    }
}
