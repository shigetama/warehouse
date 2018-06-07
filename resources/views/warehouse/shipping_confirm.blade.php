@extends('layouts.default')

@section('title', 'warehouse')

@section('head')

@endsection
@section('main')
  <div class="container">
    <h1>出庫情報確定</h1>
    <hr>
      <form id="shipplan_search" action="" method="post">
        {{ csrf_field() }}
        期間&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input class="shipplan_search" type="date" name="bef_ship_date" value="">
        ~
        <input class="shipplan_search" type="date" name="aft_ship_date" value=""><br>
        予定番号&nbsp;
        <input form="shipplan_search" class="shipplan_search" type="number" name="shipplan_id" value=""><br>
        <input form="shipplan_search" class="shipplan_search" type="submit" name="" value="検索">
      </form>
    <hr>
      <table class="table table-striped">
        <thead>
          <tr class="row">
            <th class="col-1">ID</th>
            <th class="col-2">予定番号</th>
            <th class="col-3">商品</th>
            <th class="col-2">個数</th>
            <th class="col-2">出庫予定</th>
            <th class="col-1"></th>
            <th class="col-1"></th>
          </tr>
        </thead>
        <tbody class="shipplan_tbody">

        </tbody>
      </table>

    </div>
@endsection
@section('script')
  <script>
  $('#shipplan_search').submit(function(event) {
      event.preventDefault();
     var $head_date = $('input[name="bef_ship_date"]').val();
     var $tail_date = $('input[name="aft_ship_date"]').val();
     var $shipplan_id = $('input[name="shipplan_id"]').val();

     $.ajax({
       type: 'get',
       url: '{{ action('LogisticController@search_shipplan') }}',
       data: {
         "shipplan_id": $shipplan_id,
         "ship_be": $head_date,
         "ship_af": $tail_date,
       },
     })
     .then(
       function(data) {
         data.forEach(function(value) {
            $('.shipplan_tbody').append('<tr class="row"></tr>');
            $('.shipplan_tbody tr:first').append('<td class="col-1">'+value.id+'</th>');
            $('.shipplan_tbody tr:first').append('<td class="col-2">'+value.shipplan_id+'</th>');
            $('.shipplan_tbody tr:first').append('<td class="col-3">'+value.item_name+'</th>');
            $('.shipplan_tbody tr:first').append('<td class="col-2">'+value.item_num+'</th>');
            $('.shipplan_tbody tr:first').append('<td class="col-2">'+value.ship_date+'</th>');
            $('.shipplan_tbody tr:first').append('<td class="col-1"><form id="ppp" class="ship_confirm" method="post" action="/shipping/confirm/'+value.id+'/create">'+'{{ csrf_field() }}'+'<input form="ppp" type="submit" value="確定"></form></th>');
            $('.shipplan_tbody tr:first').append('<td class="col-1"><form id="ddd" method="post" action="/shipping/plan/'+value.id+'/delete">'+'{{ csrf_field() }}'+'{{ method_field('delete') }}'+'<input form="ddd" type="submit" value="削除"></form></th>');
            $(".shipplan_search").prop("disabled", true);
          });
       },
       function() {
         $('.shipplan_tbody').append('<tr class="row"></tr>');
         $('.shipplan_tbody tr:first').append('<td class="col-12">該当するデータがありません</th>');
         $(".shipplan_search").prop("disabled", true);
       });
  });

  </script>
@endsection
