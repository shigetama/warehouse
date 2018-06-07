@extends('layouts.default')

@section('title', 'warehouse')

@section('head')

@endsection
@section('main')
  <div class="container">
    <h1>入庫予定情報入力</h1>
    <form id="rec_header_form" method="post" action='{{ action('LogisticController@create_rec_plan') }}'>
      {{ csrf_field() }}
    </form>
        <div class="main_header">
          <hr>
          <h2>入庫情報</h2>
              入庫番号&nbsp;
                  <input form="rec_header_form" type="number" name="receiving_no" value="{{ $new_recplan_id }}" readonly><br>
              倉庫&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <select form="rec_header_form" name="warehouse" size="1">
                    @forelse($warehouses as $warehouse)
                      <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                    @empty
                    @endforelse
                  </select>
              <br>
              入庫日&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input form="rec_header_form" type="date" name="receiving_date" value="{{ $now->format('Y-m-d') }}"><br>
              仕入先&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <select form="rec_header_form" name="supplier" size="1">
                    @forelse($suppliers as $supplier)
                      <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @empty
                    @endforelse
                  </select>
        </div>

        <div class="main_footer">
          <hr>
          <h2>商品情報</h2>
          <form id="item_add_form" method="post" action='{{ action('LogisticController@create_rec_plan') }}'>
              {{ csrf_field() }}
            </form>
            商品番号&nbsp;
            <input class="add_item" form="item_add_form" type="text" name="" value="">
            <input class="add_item_name" form="item_add_form" type="text" name="" value="" placeholder="商品名称" disabled>
                <button class="item_search_btn">検索</button><br>
            数量&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input id="add_number" form="item_add_form" type="number" name="" value="1"><br>
            <input id="add_item_btn" form="item_add_form" type="submit" value="追加">
          </div>

        <div class="item_footer">
          <hr>
            <table class="table table-striped">
              <thead>
                <tr class="row">
                  <th class="col-2">商品ID</th>
                  <th class="col-8">商品名称</th>
                  <th class="col-2">個数</th>
                </tr>
              </thead>
              <tbody id="show_items">

              </tbody>
            </table>
          <hr>
        </div>
      <input form="rec_header_form" type="submit" value="送信">

  </div>
@endsection
@section('script')
  <script>
  // 商品追加
    $('#item_add_form').submit(function(event) {
      event.preventDefault();

      var item = $('.add_item').val();
      var number = $('#add_number').val();
      var name = $('.add_item_name').val();

      $('#show_items').prepend('<tr></tr>');
      $('#show_items tr:first').addClass('row');
        $('#show_items tr:first').append('<td>'+item+'</td>');
          $('#show_items tr:first td:first').addClass('col-2');
        $('#show_items tr:first').append('<td class="col-8">'+name+'</td>');
        $('#show_items tr:first').append('<td>'+number+'</td>');
          $('#show_items tr:first td:last').addClass('col-2');
        $('#show_items tr:first').append('<input>');
        $('#show_items tr:first').append('<input>');
        $('#show_items tr:first input:first').attr('form','rec_header_form')
                                    .attr('type','hidden')
                                    .attr('name','item_list[]')
                                    .attr('value', item);
        $('#show_items tr:first input:last').attr('form','rec_header_form')
                                    .attr('type','hidden')
                                    .attr('name','item_number[]')
                                    .attr('value', number);
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
  </script>
@endsection
