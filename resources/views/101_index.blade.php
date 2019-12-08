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
<link href="css/reset.css" rel="stylesheet">
<link href="css/custom.css" rel="stylesheet">
<meta name="viewport" content="width=device-width">
<!--ホームアイコンの設定-->
<link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
<link rel="apple-touch-icon" href="./images/apple-touch-icon.png" sizes="180x180">
<link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon">
<link rel="icon" type="image/png" href="./images/android-touch-icon.png" sizes="192x192">
<title>家計簿</title>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="index.php"><img src="images/common/home_icon.png" class="nav-homeicon bg-white"><a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu"
     aria-controls="navmenu" area-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
     </button>
    <p class="text-white d-inline">ログイン中:{{$user->name}}さん</p> 
    <a href="{{ route('logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">ログアウト</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
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
  <div class="container col-xs-12 mtpx-100">
    <div class="row"><!--container-->
        <div class="pnl-img col-md-10 col-md-offset-1 container">
          <img src="images/101/money_kakeibo_ase.png">
          <p>家計簿をつける</p>
          <a href="./input_book"></a>
        </div>
        <div class="pnl-img col-md-10 col-md-offset-1 container">
          <img src="images/101/bunbougu_note.png">
          <p>家計簿を見る</p>
          <a href="./read_book"></a>
        </div>
        <div class="pnl-img col-md-10 col-md-offset-1 container">
          <img src="images/101/document_report.png">
          <p>年表を見る</p>
          <a href="./read_book_aggregate?table_name=category_balance"></a>
        </div>
        <div class="pnl-img col-md-10 col-md-offset-1 container">
          <img src="images/101/haguruma_gear_set_rittai.png">
          <p>費目の設定</p>
          <a href=""></a><!--開発中-->
        </div>
    </div><!--row-->
  </div><!--container-->
</body>
</html>