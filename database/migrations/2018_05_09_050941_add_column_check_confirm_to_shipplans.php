<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCheckConfirmToShipplans extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('shipplans', function (Blueprint $table) {
        $table
          ->boolean('check_confirm')
          ->default('0')
          ->after('item_num');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('shopplans', function (Blueprint $table) {
          $table->dropColumn('check_confirm');
        });
    }
}
