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
    <link href="css/text_format.css" rel="stylesheet">

        <title>家計簿</title>
    </head>

<body>
  <div class="row">
    <div class="container col-md-8 col-md-offset-2">
      <h4>記入完了</h4>
      <div class="row">
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
              <tr> <td>収支</td><td>{{$request->category_balance}}</td> </tr>
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