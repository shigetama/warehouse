@extends('layouts.default')

@section('title', 'items')

@section('head')

@endsection
@section('main')

  <div class="text-center">
    <h1>商品マスタ</h1>
    <form class="" action="{{ action('MasterController@create_item') }}" method="post">
      @if ($errors->has('body'))
        <span class="error">{{ $errors->first('body') }}</span>
      @endif
      {{ csrf_field() }}
      商品名<input type="text" name="item_name" value=""><br>
      重量<input type="number" name="weight" value=""><br>
      体積<input type="number" name="volume" value=""><br>
      <input type="submit" value="作成">
    </form>
  </div>
@endsection
