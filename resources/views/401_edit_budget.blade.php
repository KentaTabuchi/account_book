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
  <meta name="viewport" content="width=device-width">
  <title>家計簿</title>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="index.php"><img src="images/common/home_icon.png" class="nav-homeicon bg-white"><a>
    <span class="navbar-text text-warning">変動費予算設定<span>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu"
     aria-controls="navmenu" area-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
     </button>
      <div class="collapse navbar-collapse" id="navmenu">
        <div class="navbar-nav">
          <a class="nav-item nav-link" href="./read_book">家計簿を見る</a>
          <a class="nav-item nav-link" href="./read_book_aggregate?table_name=category_balance">年表を見る</a>
        </div>
        <!--.navbar-nav-->
      </div>
      <!--#navmenu-->
  </nav>


  <div class="row　justify-content-around mtpx-100">
    <div class="container col-10 offset-md-1 col-lg-4 card pnl-input-month bg-light" id="input_form">
      <form action="edit_budget" method="post" id="form" >
      @csrf
      <div id="app" class="mt-2 card bg-success">
      <label class="txt-itemname text-white col-4" >年代</label>
            <select-year class="col-8 mb-2"></select-year>
      </div>
        <div class="form-group row mt-4" >
          <label class="txt-itemname" >1月</label>
          <div class="col-8">
            <input type="text" value="{{$budgets[1]}}" name="budget_1" class="form-control" >
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >2月</label>
          <div class="col-8">
            <input type="text" value="{{$budgets[2]}}" name="budget_2" class="form-control" >
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >3月</label>
          <div class="col-8">
            <input type="text" value="{{$budgets[3]}}" name="budget_3" class="form-control" >
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >4月</label>
          <div class="col-8">
            <input type="text" value="{{$budgets[4]}}" name="budget_4" class="form-control" >
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >5月</label>
          <div class="col-8">
            <input type="text" value="{{$budgets[5]}}" name="budget_5" class="form-control" >
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >6月</label>
          <div class="col-8">
            <input type="text" value="{{$budgets[6]}}" name="budget_6" class="form-control" >
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >7月</label>
          <div class="col-8">
            <input type="text" value="{{$budgets[7]}}" name="budget_7" class="form-control" >
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >8月</label>
          <div class="col-8">
            <input type="text" value="{{$budgets[8]}}" name="budget_8" class="form-control" >
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname">9月</label>
          <div class="col-8">
            <input type="text" value="{{$budgets[9]}}" name="budget_9" class="form-control" >
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname">10月</label>
          <div class="col-8">
            <input type="text" value="{{$budgets[10]}}" name="budget_10" class="form-control" >
          </div>
        </div><!--form-group row-->
          <div class="form-group row" >
          <label class="txt-itemname" >11月</label>
          <div class="col-8">
            <input type="text" value="{{$budgets[11]}}" name="budget_11" class="form-control" >
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >12月</label>
          <div class="col-8">
            <input type="text" value="{{$budgets[12]}}" name="budget_12" class="form-control" >
          </div>
        </div><!--form-group row-->
        <div class="row mt-5">
          <div class="container col-6 col-md-offset-1 mb-5">
            <input type="submit" class="btn-lg btn-block btn-primary" value="更新する">
          </div>
        </div><!--row-->
        <input type="hidden" name="year" value={{$year}}>
      </form>
    </div>
  </div><!--row-->
<script src="{{ URL::asset('/js/app.js')}}"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>
</html>