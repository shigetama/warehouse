@extends('layouts.default')

@section('title', 'home')

@section('head')

@endsection
@section('main')
  <div class="container text-center">

    @if(session('status'))
      <div class="container mt-w">
        <div class="alert alert-danger">
          {{ session('status') }}
        </div>
      </div>
    @endif

    <h1>機能一覧</h1>
    <div class="row">
      <div class="col-4">
        <table class="table table-striped table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <th>入庫機能</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a href="/receiving/plan">入庫予定</a></td>
            </tr>
            <tr>
              <td><a href="/receiving/confirm">入庫確定</a></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-4">
        <table class="table table-striped table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <th>出庫機能</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a href="/shipping/plan">出庫予定</a></td>
            </tr>
            <tr>
              <td>※在庫引き当て</td>
            </tr>
            <tr>
              <td><a href="/shipping/confirm">出庫確定</a></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-4">
        <table class="table table-striped table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <th>在庫機能</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><a href="/inquiry/stock">在庫照会</a></td>
            </tr>
            <tr>
              <td>受払照会</td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row">
      <div class="col-4">
        <table class="table table-striped table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <th>マスタ機能</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>ユーザ</td>
            </tr>
            <tr>
              <td><a href="/master/item">商品</a></td>
            </tr>
            <tr>
              <td><a href="/master/supplier">仕入先</a></td>
            </tr>
            <tr>
              <td><a href="/master/delivery">納品先</a></td>
            </tr>
            <tr>
              <td><a href="/master/warehouse">倉庫</a></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-4">
        <table class="table table-striped table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <th>その他</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>なし</td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="col-4">
        <table class="table table-striped table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <th>その他</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>なし</td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
            <tr>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
@section('script')
  <script>

  </script>
@endsection
