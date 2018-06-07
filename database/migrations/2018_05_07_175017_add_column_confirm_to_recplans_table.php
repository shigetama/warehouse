<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnConfirmToRecplansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('recplans', function (Blueprint $table) {
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
      Schema::table('recplans', function (Blueprint $table) {
          $table->dropColumn('check_confirm');
        });
    }
}
