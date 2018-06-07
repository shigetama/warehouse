<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Warehouse;
use App\Item;
use App\Supplier;
use App\Recplan;
use App\Recconfirm;
use App\Stock;
use App\Delivery;
use App\Shipplan;
use App\Shipconfirm;

class LogisticController extends Controller
{
  public function index() {
    return view('warehouse.home');
  }

  // 入庫予定
    public function receiving_plan() {
      $warehouses = Warehouse::get();
      $items = Item::get();
      $suppliers = Supplier::get();
      if(Recplan::first()){
        $new_recplan_id = Recplan::orderBy('recplan_id', 'DESC')->first()->recplan_id + 1;
      }else{
        $new_recplan_id = 1;
      }

      return view('warehouse.receiving_plan')->with(['warehouses' => $warehouses,
                                                    'items' => $items,
                                                    'suppliers' => $suppliers,
                                                    'new_recplan_id' => $new_recplan_id]);
    }

    public function create_rec_plan(Request $request) {
        for ($i = 0; $i < count($request->item_list); $i++){
          $recplan = new Recplan();
          $recplan->recplan_id = $request->receiving_no;
          $recplan->rec_date = $request->receiving_date;
          $recplan->warehouse_id = $request->warehouse;
          $recplan->item_id = $request->item_list[$i];
          $recplan->item_num = $request->item_number[$i];
          $recplan->save();
        }
      return redirect('/receiving/plan');
    }
// 入庫確定
  public function receiving_confirm() {
    $recplans = Recplan::get()->where('check_confirm','0');
    return view('warehouse.receiving_confirm')->with(['recplans' => $recplans]);
  }
  // 入庫確定
  public function create_rec_confirm(Recplan $recplan) {
    $confirm = new Recconfirm();
    $confirm->rec_plan_id = $recplan->recplan_id;
    $confirm->item_id = $recplan->item_id;
    $confirm->item_num = $recplan->item_num;
    $confirm->warehouse_id = $recplan->warehouse_id;
    $confirm->save();

    $recplan->check_confirm = 1;
    $recplan->save();

    $now_stock = Stock::where('item_id', $recplan->item_id)->first();
    if($now_stock){
      $now_stock->item_num += $recplan->item_num;
      $now_stock->save();
    }else{
      $stock = new Stock();
      $stock->warehouse_id = $recplan->warehouse_id;
      $stock->item_id = $recplan->item_id;
      $stock->item_num = $recplan->item_num;
      $stock->save();
    }

    return redirect('/receiving/confirm');
  }
  // 入庫予定取り消し
  public function delete_rec_plan(Recplan $recplan) {
    $now_recplan = Recplan::where('id', $recplan->id)->first();
    $now_recplan->delete();
    return redirect('/receiving/confirm');
  }
  // 出庫
  public function shipping_plan() {
    $warehouses = Warehouse::get();
    $items = Item::get();
    $deliveries = Delivery::get();
    if(Shipplan::first()){
      $new_shipplan_id = Shipplan::orderBy('shipplan_id', 'DESC')->first()->shipplan_id + 1;
    }else{
      $new_shipplan_id = 1;
    }


    return view('warehouse.shipping_plan')->with(['warehouses' => $warehouses,
                                                  'items' => $items,
                                                  'deliveries' => $deliveries,
                                                  'new_shipplan_id' => $new_shipplan_id]);
  }
  public function create_ship_plan(Request $request) {
    // 在庫チェック
    $now_stock = Stock::get();
    $item_lists = $request->item_list;
    $item_numbers = $request->item_number;
    for($i = 0; $i < count($item_lists); $i++){
      if($now_stock->where('item_id', $item_lists[$i])->first()
          && $now_stock->where('item_id', $item_lists[$i])->first()->item_num
          -  $now_stock->where('item_id', $item_lists[$i])->first()->provision_num
          - $item_numbers[$i] >= 0){
      }else{
        return redirect('/shipping/plan')->with('status', __('商品「'.$item_lists[$i].'」'.'の在庫が足りません'));
      }
    }
    // 出庫予定登録
    for ($i = 0; $i < count($request->item_list); $i++){
      $shipplan = new Shipplan();
      $shipplan->shipplan_id = $request->shipping_no;
      $shipplan->ship_date = $request->shipping_date;
      $shipplan->warehouse_id = $request->warehouse;
      $shipplan->item_id = $request->item_list[$i];
      $shipplan->item_num = $request->item_number[$i];
      $shipplan->save();
    // 引き当て個数追加
      $new_stock = $now_stock
                          ->where('item_id', $request->item_list[$i])
                          ->first();
      $new_stock->provision_num += $request->item_number[$i];
      $new_stock->save();
    }
    return redirect('/shipping/plan');
  }
// 出庫確定
public function shipping_confirm() {
  $shipplans = Shipplan::get()->where('check_confirm','0');
  return view('warehouse.shipping_confirm')->with(['shipplans' => $shipplans]);;
}
public function create_ship_confirm(Shipplan $shipplan) {
// 確定レコード作成
  $confirm = new Shipconfirm();
  $confirm->ship_plan_id = $shipplan->shipplan_id;
  $confirm->item_id = $shipplan->item_id;
  $confirm->item_num = $shipplan->item_num;
  $confirm->warehouse_id = $shipplan->warehouse_id;
  $confirm->save();
// 確定チェック
  $shipplan->check_confirm = 1;
  $shipplan->save();
// 在庫、引き当て減算
  $stock = Stock::where('id', $shipplan->item_id)->first();
  $stock->item_num -= $shipplan->item_num;
  $stock->provision_num -= $shipplan->item_num;
  $stock->save();
  return redirect('/shipping/confirm');
}
// 出庫予定取り消し
public function delete_ship_plan(Shipplan $shipplan) {
  $now_shipplan = Shipplan::where('id', $shipplan->id)->first();
  $now_shipplan->delete();

  $stock = Stock::where('item_id', $shipplan->item_id)->first();
  $stock->provision_num -= $shipplan->item_num;
  $stock->save();
  return redirect('/shipping/confirm');
}
// 在庫
  public function inquiry_stock() {
    return view('warehouse.inquiry_stock');
  }
// 在庫ajax
  public function show_stock(Request $request) {
    $stocks = Stock::where('item_id', $request->item_id)->first();
    $stocks->item_name = Item::where('id',$request->item_id)->first()->name;
    if($stocks){
      return $stocks;
    }else{
      return '該当するデータがありません';
    }
  }
  // 入庫予定検索
    public function search_recplan(Request $request) {
      $search_recplans_query = Recplan::where('check_confirm', 0);
      if($request->recplan_id != null){
        $search_recplans_query = $search_recplans_query->where('recplan_id', $request->recplan_id);}
      if($request->rec_be != null) {
        $search_recplans_query = $search_recplans_query->where('rec_date', '>=', $request->rec_be);}
      if($request->rec_af != null) {
        $search_recplans_query = $search_recplans_query->where('rec_date', '<=', $request->rec_af);}

        $search_recplans = $search_recplans_query->get();

      foreach($search_recplans as $recplan){
        // $recplan->item_name = Item::where('id',$recplan->item_id)->first()->name;
        // $recplan->item_name = $recplan->items();
        logger($recplan->item);
        $recplan->item_name = $recplan->item->name;
      }
      if($search_recplans->all()){
        return $search_recplans->toArray();
      }else{
        return false;
      }

    }

  // 出庫予定検索
    public function search_shipplan(Request $request) {
      $search_shipplans = Shipplan::where('check_confirm', 0)->get();
      if($request->shipplan_id != null){
        $search_shipplans = Shipplan::where('check_confirm', 0)->where('shipplan_id', $request->shipplan_id)->get();}
      if($request->ship_date != null) {
        $search_shipplans = $search_shipplans->where('ship_date', '>=', $request->ship_be)->get();}
      if($request->ship_date != null) {
        $search_shipplans = $search_shipplans->where('ship_date', '<=', $request->ship_af)->get();}

      foreach($search_shipplans as $shipplan){
        $shipplan->item_name = Item::where('id',$shipplan->item_id)->first()->name;
      }
      if($search_shipplans->all()){
        return $search_shipplans->toArray();
      }else{
        return false;
      }

    }

// 商品検索
    public function search_item() {
      $items = Item::get();
      return view('warehouse.search_item')->with(['items' => $items]);
    }
// 商品名称補完
    public function search_item_name(Request $request) {
      $item = Item::where('id',$request->item_id)->first();
      $x = $item->name;
        return $x;
    }
}
