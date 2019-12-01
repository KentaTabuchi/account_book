<!DOCTYPE html>
<html lang="ja">
    <head>
    <meta charset="utf-8">
    <!-- BootstrapのCSS読み込み -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
    <script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <!-- Vue.jsのJS読み込み -->    
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
    <meta name="viewport" content="width=device-width">
    <link href="css/custom.css" rel="stylesheet">
    <title>家計簿</title>
    </head>

<body>
<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="index.php"><img src="images/common/home_icon.png" class="nav-homeicon bg-white"><a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu"
     aria-controls="navmenu" area-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
     </button>
      <div class="collapse navbar-collapse" id="navmenu">
        <div class="navbar-nav">
          <a class="nav-item nav-link" href="./input_book">家計簿をつける</a>
          <a class="nav-item nav-link" href="./read_book_aggregate?table_name=category_balance">年表を見る</a>
        </div>
        <!--.navbar-nav-->
      </div>
      <!--#navmenu-->
  </nav>
  <div class="row mtpx-100">
    <div class="container col-md-8 justify-content-around">
        <table class="table table-dark col-xs-10 col-md-10 offset-1" data-toggle="table" data-pagination="true">
          <thead class="thead-light">
          <tr>
            <th>編集</th>
            <th class="d-none d-md-table-cell" data-sortable="true">日付</th>
            <th class="d-none d-md-table-cell" data-sortable="true">収支</th>
            <th class="d-none d-md-table-cell" data-sortable="true" class="d-none d-md-table-cell">大分類</th>
            <th class="d-none d-md-table-cell" data-sortable="true">中分類</th>
            <th data-sortable="true">小分類</th>
            <th>メモ</th>
            <th data-sortable="true">金額</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($record as $item)
          <tr>
            <td><button type="button" onclick="location.href='edit_book?id={{$item->id}}'">id:{{$item->id}}</button></td>
            <td class="d-none d-md-table-cell">{{$item->pay_day}}</td>
            <td>{{$item->balance_name}}</td>
            <td class="d-none d-md-table-cell">{{$item->large_name}}</td>
            <td>{{$item->middle_name}}</td>
            <td>{{$item->small_name}}</td>
            <td>{{$item->memo}}</td>
            <td>{{$item->payment}}</td>
          </tr>         
          @endforeach

          </tbody>
        </table>
    </div>

  </div><!--row-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>
</html>