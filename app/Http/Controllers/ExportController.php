<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Excel;

class ExportController extends Controller
{
    public function export_excel() {
      return view('warehouse.export_excel');
    }

    public function items_export() {
      $items = Item::all();

      Excel::create('items', function($excel) use($items) {
        $excel->sheet('Sheet 1', function($sheet) use($items) {
          $sheet->fromArray($items);
        });
      })->export('xls');
    }
}
