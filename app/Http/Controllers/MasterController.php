<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Warehouse;
use App\Supplier;
use App\Delivery;

class MasterController extends Controller
{
  // アイテムマスタ
    public function items() {
      return view('warehouse.item_master');
    }
    public function create_item(Request $request) {
      $item = new Item();

      $item->name = $request->item_name;
      $item->weight = $request->weight;
      $item->volume = $request->volume;
      $item->save();
      return redirect('/master/item');
    }
  // 倉庫マスタ
    public function warehouse() {
      return view('warehouse.warehouse_master');
    }
    public function create_warehouse(Request $request) {
      $warehouse = new Warehouse();

      $warehouse->name = $request->warehouse_name;
      $warehouse->addless = $request->addless;
      $warehouse->other = $request->other;
      $warehouse->save();

      return redirect('/master/warehouse');
    }
  // 仕入先マスタ
    public function supplier() {
      return view('warehouse.supplier_master');
    }
    public function create_supplier(Request $request) {
      $supplier = new Supplier();

      $supplier->name = $request->supplier_name;
      $supplier->addless = $request->addless;
      $supplier->other = $request->other;
      $supplier->save();

      return redirect('/master/supplier');
    }
  // 納品先
  public function delivery() {
    return view('warehouse.delivery_master');
  }
  public function create_delivery(Request $request) {
    $delivery = new Delivery();

    $delivery->name = $request->delivery_name;
    $delivery->addless = $request->addless;
    $delivery->other = $request->other;
    $delivery->save();

    return redirect('/master/delivery');
  }

}
