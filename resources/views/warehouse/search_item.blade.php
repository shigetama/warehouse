<!DOCTYPE html>
<html lang="ja" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>search_item</title>
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

  </head>
  <body>
    <div class="container">
      <h1 class="text-center">商品</h1>
        <table class="table table-striped table-bordered table-hover table-condensed">
          <thead>
            <tr>
              <th>商品番号</th>
              <th>商品名称</th>
              <th>重量</th>
              <th>体積</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @forelse($items as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->weight }}</td>
                <td>{{ $item->volume }}</td>
                <td><button data-itemid="{{ $item->id }}" data-itemname="{{ $item->name }}" class="item_select_button">選択</button></td>
              </tr>
            @empty
            @endforelse
          </body>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
      $('.item_select_button').click(function() {
        var item_id = $(this).data('itemid');
        var item_name = $(this).data('itemname');
        window.opener.$('.add_item').attr('value', item_id);
        window.opener.$('.add_item_name').attr('value', item_name);
        window.close();
      });
    </script>
  </body>
</html>
