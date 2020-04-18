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
  <!-- Vue.jsのJS読み込み -->    
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
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
          <a class="nav-item nav-link" href="./read_book">家計簿を見る</a>
          <a class="nav-item nav-link" href="./read_book_aggregate?table_name=category_balance">年表を見る</a>
        </div>
        <!--.navbar-nav-->
      </div>
      <!--#navmenu-->
  </nav>
  <div class="row mtpx-100">
        <div class="card col-md-12 container">
          <table class="table">
            <thead class="table-light">
              <tr>
                <th class="col-xs-2">項目</th>
                <th class="col-xs-10">入力値</th>
              </tr>
            </thead>
            <tbody  class="table-dark">
              <tr> <td>日付</td><td>{{$today}}</td> </tr>
              <tr> <td>収支</td><td>{{$request->category_balance}}</td> </tr>
              <tr> <td>大分類</td><td>{{$request->category_large}}</td> </tr>
              <tr> <td>中分類</td><td>{{$request->category_middle}}</td> </tr>
              <tr> <td>小分類</td><td>{{$request->category_small}}</td> </tr>
              <tr> <td>メモ</td><td>{{$request->memo}}</td> </tr>
              <tr> <td>金額</td><td class="txt-currency">{{$request->payment}}</td> </tr>
            </tbody>
          </table>
        </div><!--card-->
      </div><!--row-->
    </div>
      <div class="container col-md-8 col-md-offset-2 mt-5">
      <button type="button" onclick="location.href='input_book'" class="btn btn-primary">続けて記入</button>
      <button type="button" onclick="location.href='index.php'" class="btn btn-primary">ホームへ</button>      
    </div>
    </div>
  </div><!--row 大枠-->
 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>
</html>