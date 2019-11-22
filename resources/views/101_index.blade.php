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
        <title>@yield('title')</title>
    </head>

<body>

  <div class="container mt-4">
      <h4>家計簿メニュー</h4>
  </div>
  <ol>
    <li><a href="./input_book">家計簿をつける</a></li>
    <li><a href="./read_book">家計簿を見る</a></li>
    <li><a>費目を登録する</a></li>
    
  <ol>
</body>
</html>