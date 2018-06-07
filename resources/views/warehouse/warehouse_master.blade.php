@extends('layouts.default')

@section('title', 'warehouse')

@section('head')

@endsection
@section('main')

  <div class="text-center">
    <h1>倉庫マスタ</h1>
    <form class="" action="{{ action('MasterController@create_warehouse') }}" method="post">
      @if ($errors->has('name'))
        <span class="error">{{ $errors->first('name') }}</span>
      @endif
      {{ csrf_field() }}
      倉庫名<input type="text" name="warehouse_name" value=""><br>
      住所<input type="text" name="addless" value=""><br>
      備考<input type="text" name="other" value=""><br>
      <input type="submit" value="作成">
    </form>
  </div>
@endsection
