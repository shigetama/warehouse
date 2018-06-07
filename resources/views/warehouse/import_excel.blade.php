@extends('layouts.default')

@section('title', 'export')

@section('head')

@endsection
@section('main')
  <div class="container">
    <h1>データ取り込み</h1>
    <hr>
    <form method="POST" action="{{ action('ImportController@items_import') }}" enctype="multipart/form-data">
      商品&nbsp;&nbsp;&nbsp;&nbsp;<input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="file" name="csv_file">
      <input type="submit" value="取込">
    </form>
    <form method="POST" action="{{ action('ImportController@suppliers_import') }}" enctype="multipart/form-data">
      仕入先<input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="file" name="csv_file">
      <input type="submit" value="取込">
    </form>
    <form method="POST" action="{{ action('ImportController@deliveries_import') }}" enctype="multipart/form-data">
      納品先<input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input type="file" name="csv_file">
      <input type="submit" value="取込">
    </form>



  </div>
@endsection
@section('script')
  <script>

  </script>
@endsection
