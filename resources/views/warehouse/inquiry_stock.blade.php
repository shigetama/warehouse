@extends('layouts.default')

@section('title', 'warehouse')

@section('head')

@endsection
@section('main')
  <div class="container">
    <h1>在庫照会</h1>
    <hr>
      <form id="recplan_search" action="" method="post">
      </form>
        {{ csrf_field() }}
        商品番号&nbsp;
        <input form="recplan_search" class="add_item" type="text" name="item_id" value="">
        <input form="recplan_search" class="add_item_name" type="text" name="" value="" placeholder="商品名称" disabled>
          <button class="item_search_btn">商品検索</button><br>
        <input form="recplan_search" class="recplan_search_btn" type="submit" name="" value="検索">


    <hr>

    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-2">商品番号</th>
          <th class="col-4">商品名称</th>
          <th class="col-2">総数</th>
          <th class="col-2">引当数</th>
          <th class="col-2">出庫可能数</th>
        </tr>
      </thead>
      <tbody id="stock_body">

      </tbody>
    </table>

    </div>
@endsection
@section('script')
  <script>
    (function() {
      'use strict';

      $('#recplan_search').submit(function(event) {
        event.preventDefault();
        var $head_date = $('input[name="rec_be"]').val();
        var $tail_date = $('input[name="rec_af"]').val();
        var $item_id = $('input[name="item_id"]').val();

        $.ajax({
          type: 'get',
          url: '{{ action('LogisticController@show_stock') }}',
          data: {
            "item_id": $item_id
          },
        })
        .then(
          function(data) {

            var $available_ship_num = data.item_num - data.provision_num;
            if(data.item_num){
              $('#stock_body').append('<tr class="row"></tr>');
              $('#stock_body tr:first').append('<td class="col-2">'+data.item_id+'</th>');
              $('#stock_body tr:first').append('<td class="col-4">'+data.item_name+'</th>');
              $('#stock_body tr:first').append('<td class="col-2">'+data.item_num+'</th>');
              $('#stock_body tr:first').append('<td class="col-2">'+data.provision_num+'</th>');
              $('#stock_body tr:first').append('<td class="col-2">'+$available_ship_num+'</th>');
              $(".recplan_search_btn").prop("disabled", true);
            }else{
              $('#stock_body').append('<tr class="row"></tr>');
              $('#stock_body tr:first').append('<td">在庫がありません</th>');
              $(".recplan_search_btn").prop("disabled", true);
            }
          },
          function() {
            $('#stock_body').append('<tr class="row"></tr>');
            $('#stock_body tr:first').append('<td">在庫がありません</th>');
            $(".recplan_search_btn").prop("disabled", true);
          });
        });

        // 商品検索
        $('.item_search_btn').click(function(event) {
          var w = ( screen.width-640 ) / 2;
          var h = ( screen.height-480 ) / 2;
          window.open("/receiving/search_item","","width=750,height=480"+",left="+w+",top="+h);
        });
        // 商品名称自動補完
        $('.add_item').keyup(function() {
          var $q = $(this).val();
          $.ajax({
            url: '/ajax/item_search',
            type: "get",
            data: {
              "item_id": $q
            },
          })
          .then(
              function (data) {$('.add_item_name').attr('value',data);},
              function () {$('.add_item_name').attr('value','');});

        });
    })();
  </script>
@endsection
