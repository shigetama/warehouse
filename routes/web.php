<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/shigewarehouse/top', 'LogisticController@index');
// ユーザー認証
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
// マスタ
Route::get('/master/item', 'MasterController@items');
Route::post('/master/item/create', 'MasterController@create_item');
Route::get('/master/warehouse', 'MasterController@warehouse');
Route::post('/master/warehouse/create', 'MasterController@create_warehouse');
Route::get('/master/supplier', 'MasterController@supplier');
Route::post('/master/supplier/create', 'MasterController@create_supplier');
Route::get('/master/delivery', 'MasterController@delivery');
Route::post('/master/delivery/create', 'MasterController@create_delivery');

// 入庫
Route::get('/receiving/plan', 'LogisticController@receiving_plan');
Route::post('/receiving/plan/create', 'LogisticController@create_rec_plan');
Route::get('/receiving/confirm', 'LogisticController@receiving_confirm');
Route::post('/receiving/confirm/{recplan}/create', 'LogisticController@create_rec_confirm');
Route::delete('/receiving/plan/{recplan}/delete', 'LogisticController@delete_rec_plan');
// 出庫
Route::get('/shipping/plan', 'LogisticController@shipping_plan');
Route::post('/shipping/plan/create', 'LogisticController@create_ship_plan');
Route::get('/shipping/confirm', 'LogisticController@shipping_confirm');
Route::post('/shipping/confirm/{shipplan}/create', 'LogisticController@create_ship_confirm');
Route::delete('/shipping/plan/{shipplan}/delete', 'LogisticController@delete_ship_plan');
// 在庫
Route::get('/inquiry/stock', 'LogisticController@inquiry_stock');
// 帳票
Route::get('/export/excel', 'ExportController@export_excel');
Route::post('/export/excel/items', 'ExportController@items_export');
Route::get('/import/excel', 'ImportController@import_excel');
Route::post('/import/excel/items', 'ImportController@items_import');
Route::post('/import/excel/suppliers', 'ImportController@suppliers_import');
Route::post('/import/excel/deliveries', 'ImportController@deliveries_import');

// 商品検索
Route::get('/receiving/search_item', 'LogisticController@search_item');
//ajax
Route::get('/ajax/item_search', 'LogisticController@search_item_name');
Route::get('/ajax/inquiry_stock', 'LogisticController@show_stock');
Route::get('/ajax/inquiry_recplan', 'LogisticController@search_recplan');
Route::get('/ajax/inquiry_shipplan', 'LogisticController@search_shipplan');
// ユーザー認証
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
