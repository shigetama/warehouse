@extends('layouts.default')

@section('title', 'export')

@section('head')

@endsection
@section('main')
  <div class="container">
    <h1>帳票出力</h1>
    <hr>
    <form class="" action="{{ action('ExportController@items_export') }}" method="post">
        {{ csrf_field() }}
      商品<input type="submit" value="出力">
    </form>

  </div>
@endsection
@section('script')
  <script>

  </script>
@endsection
