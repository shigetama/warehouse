<!doctype html>
<html lang="ja">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <style>
      body {background-color: #eaeaea;}
      body, html {height: 100%;}
      a, a:visited {color : black;}
      .header_img {background-image: url("/images/stone.jpg"); height: 130px;}
      .drop_menu_btn {border: 3px solid black;}
      footer {height: 80px; background-image: url("/images/stone.jpg"); margin-top:10px;}
    </style>

    <title>@yield('title')</title>
    @yield('head')
  </head>
  <body>
    <head>
      <div class="header_img">

        <div class="container pt-3 ml-5">
          <div class="home_btn">
            <a href="/">
              <h1>XXXXX<br>
              warehouse</h1>
            </a>
          </div>
        </div>
      </div>

      <div class="dropdown row ">
        <div class="col-2 p-0 drop_menu_btn">
          <div class="dropdown-toggle text-center" type="button" data-toggle="dropdown">入庫機能
          <span class="carett"></span></div>
          <ul class="dropdown-menu text-center">
            <li><a href="/receiving/plan">入庫予定</a></li>
            <li><a href="/receiving/confirm">入庫確定</a></li>
          </ul>
        </div>
        <div class="col-2 p-0 drop_menu_btn">
          <div class="dropdown-toggle text-center" type="button" data-toggle="dropdown">出庫機能
          <span class="carett"></span></div>
          <ul class="dropdown-menu text-center">
            <li><a href="/shipping/plan">出庫予定</a></li>
            <li><a href="#">(保留)在庫引当</a></li>
            <li><a href="/shipping/confirm">出庫確定</a></li>
          </ul>
        </div>
        <div class="col-2 p-0 drop_menu_btn">
          <div class="dropdown-toggle text-center" type="button" data-toggle="dropdown">在庫機能
          <span class="carett"></span></div>
          <ul class="dropdown-menu text-center">
            <li><a href="/inquiry/stock">在庫照会</a></li>
            <li><a href="#">受払照会</a></li>
          </ul>
        </div>
        <div class="col-2 p-0 drop_menu_btn">
          <div class="dropdown-toggle text-center" type="button" data-toggle="dropdown">マスタ機能
          <span class="carett"></span></div>
          <ul class="dropdown-menu text-center">
            <li><a href="#">ユーザー</a></li>
            <li><a href="/master/item">商品</a></li>
            <li><a href="/master/supplier">仕入先</a></li>
            <li><a href="/master/delivery">納品先</a></li>
            <li><a href="/master/warehouse">倉庫</a></li>
          </ul>
        </div>
        <div class="col-2 p-0 drop_menu_btn">
          <div class="dropdown-toggle text-center" type="button" data-toggle="dropdown">帳票
          <span class="carett"></span></div>
          <ul class="dropdown-menu text-center">
            <li><a href="/export/excel">データ出力</a></li>
            <li><a href="/import/excel">データ取り込み</a></li>
          </ul>
        </div>
        <div class="col-2 p-0 drop_menu_btn">
          <div class="dropdown-toggle text-center" type="button" data-toggle="dropdown">その他
          <span class="carett"></span></div>
          <ul class="dropdown-menu text-center">
            <li><a href="#">なし</a></li>
          </ul>
        </div>
      </div>
    </head>
    <main>
      @yield('main')
    </main>
    <footer>
      <div class="text-center pt-4">
          Copyright ©2018 SHIGETA. All rights reserved.
      </div>
    </footer>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    @yield('script')
  </body>
</html>
