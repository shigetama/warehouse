@extends('layouts.default')

@section('title', 'warehouse')

@section('head')

@endsection
@section('main')
  <div class="container">
    <h1>入庫情報確定</h1>
    <hr>
      <form id="recplan_search" action="" method="post">
        {{ csrf_field() }}

        期間&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input form="recplan_search" class="recplan_search" type="date" name="bef_rec_date" value="">
        ~
        <input form="recplan_search" class="recplan_search" type="date" name="aft_rec_date" value=""><br>
        予定番号&nbsp;
        <input form="recplan_search" class="recplan_search" type="number" name="recplan_id" value=""><br>
        <input form="recplan_search" class="recplan_search" type="submit" name="" value="検索">
      </form>
    <hr>
      <table class="table table-striped">
        <thead>
          <tr class="row">
            <th class="col-1">ID</th>
            <th class="col-2">予定番号</th>
            <th class="col-3">商品</th>
            <th class="col-2">個数</th>
            <th class="col-2">入庫予定</th>
            <th class="col-1"></th>
            <th class="col-1"></th>
          </tr>
        </thead>
        <tbody class="recplan_tbody">

        </tbody>
      </table>

    </div>
@endsection
@section('script')
  <script>
    (function() {
      'use strict';
// 入庫情報検索
      $('#recplan_search').submit(function(event) {
          event.preventDefault();
         var $head_date = $('input[name="bef_rec_date"]').val();
         var $tail_date = $('input[name="aft_rec_date"]').val();
         var $recplan_id = $('input[name="recplan_id"]').val();

         $.ajax({
           type: 'get',
           url: '{{ action('LogisticController@search_recplan') }}',
           data: {
             "recplan_id": $recplan_id,
             "rec_be": $head_date,
             "rec_af": $tail_date,
           },
         })
         .then(
           function(data) {
             data.forEach(function(value) {
                $('.recplan_tbody').append('<tr class="row"></tr>');
                $('.recplan_tbody tr:first').append('<td class="col-1">'+value.id+'</th>');
                $('.recplan_tbody tr:first').append('<td class="col-2">'+value.recplan_id+'</th>');
                $('.recplan_tbody tr:first').append('<td class="col-3">'+value.item_name+'</th>');
                $('.recplan_tbody tr:first').append('<td class="col-2">'+value.item_num+'</th>');
                $('.recplan_tbody tr:first').append('<td class="col-2">'+value.rec_date+'</th>');
                $('.recplan_tbody tr:first').append('<td class="col-1"><form id="ppp" class="rec_confirm" method="post" action="/receiving/confirm/'+value.id+'/create">'+'{{ csrf_field() }}'+'<input form="ppp" type="submit" value="確定"></form></th>');
                $('.recplan_tbody tr:first').append('<td class="col-1"><form id="ddd" method="post" action="/receiving/plan/'+value.id+'/delete">'+'{{ csrf_field() }}'+'{{ method_field('delete') }}'+'<input form="ddd" type="submit" value="削除"></form></th>');
                $(".recplan_search").prop("disabled", true);
              });
           },
           function() {
             $('.recplan_tbody').append('<tr class="row"></tr>');
             $('.recplan_tbody tr:first').append('<td class="col-12">該当するデータがありません</th>');
             $(".recplan_search").prop("disabled", true);
           });
      });

    })();
  </script>
@endsection
