<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Item;

class ImportController extends Controller
{
    public function import_excel() {
      return view('warehouse.import_excel');
    }
// 商品マスタ追加
    public function items_import(Request $request) {
      $file = $request->file('csv_file');
      $reader = Excel::load($file->getRealPath(), 'SJIS-win');
      $rows = $reader->toArray();

      foreach ($rows as $row) {
        $item = new Item();
        $item->name = $row[1];
        $item->weight = $row[2];
        $item->volume = $row[3];
        $item->save();
      }
      return redirect('/import/excel');
    }
// 仕入先マスタ追加
    public function suppliers_impoert() {

    }
// 納品先マスタ追加
    public function deliveries_import() {

    }
}
