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
<link href="css/custom_panel.css" rel="stylesheet">
<title>家計簿</title>
</head>

<body>

  <div class="container mt-4">
  </div>
  <div class="container col-10">
    <div class="row"><!--container-->
        <div class="pnl-img col-md-4">
          <img src="images/101/money_kakeibo_ase.png">
          <p>家計簿をつける</p>
          <a href="./input_book"></a>
        </div>
        <div class="pnl-img col-md-4">
          <img src="images/101/bunbougu_note.png">
          <p>家計簿を見る</p>
          <a href="./read_book"></a>
        </div>
        <div class="pnl-img col-md-4">
          <img src="images/101/document_report.png">
          <p>年表を見る</p>
          <a href="./read_book_aggregate?table_name=category_balance"></a>
        </div>
        <div class="pnl-img col-md-4">
          <img src="images/101/haguruma_gear_set_rittai.png">
          <p>費目の設定</p>
          <a href=""></a><!--開発中-->
        </div>
    </div><!--row-->
  </div><!--container-->
</body>
</html>