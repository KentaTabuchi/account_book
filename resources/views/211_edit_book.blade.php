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
    <span class="navbar-text text-warning">既存編集<span>
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
    <div class="container col-md-10 offset-md-1 col-lg-4 card" id="input_form">
      <form action="edit_book" method="post" id="form" >
      @csrf
      <div class="row" >
          <div class="container col-md-10 offset-md-1">
            <label for="category_balance" class="txt-itemname" >日付</label>
            <p class="text-success text-sm">&#40;{{$old->pay_day}}&#41;</p>
            <input type="text" name="pay_day" class="form-control" value="{{$old->pay_day}}">
          </div>
        </div><!--row-->
        <div class="row" >
          <div class="container col-md-10 offset-md-1">
            <label for="category_balance" class="txt-itemname">収支</label>
            <p class="text-success text-sm">&#40;{{$old->balance_name}}&#41;</p>
            <select name="category_balance" class="form-control" 
            id="category_balance" v-model="category_balance">
              <option v-for="item in json_balance">@{{item.name}}</option>
          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="category_large" class="txt-itemname">大分類</label>
            <p class="text-success text-sm">&#40;{{$old->large_name}}&#41;</p>
            <select name="category_large" class="form-control" id="category_large" v-model="category_large">
              <option v-for="item in json_large">@{{item.name}}</option>
          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="category_middle" class="txt-itemname">中分類</label>
            <p class="text-success text-sm">&#40;{{$old->middle_name}}&#41;</p>
            <select name="category_middle"  class="form-control" id="category_middle" v-model="category_middle">
              <option v-for="item in json_middle">@{{item.name}}</option>
          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="category_small" class="txt-itemname">小分類</label>
            <p class="text-success text-sm">&#40;{{$old->small_name}}&#41;</p>
            <select name="category_small" class="form-control" id="category_small" v-model="category_small">
            <option v-for="item in json_small">@{{item.name}}</option>
          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="category_balance" class="txt-itemname">メモ</label>
            <p class="text-success text-sm">&#40;{{$old->memo}}&#41;</p>
            <input type="text"  name="memo" class="form-control" id="category_balance" v-model="memo"
              value = "{{$old->memo}}">
          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="payment" class="txt-itemname">金額</label>
            <p class="text-success text-sm">&#40;{{$old->payment}}&#41;</p>
            <input type="text" id="payment"  name="payment" class="form-control" 
            v-model="payment">
            @if($errors->has('payment'))
            <p>整数を入力してください。</p>
            @endif

          </div>
        </div><!--row-->
        <div class="row mt-5">
          <div class="container col-6 col-md-offset-1 mb-5">
            <input type="submit" class="btn-lg btn-block btn-primary" value="更新する">
          </div>
        </div><!--row-->
        <input type="hidden" name="changed_form" v-model="changed_form">
        <input type="hidden" name="id" value="{{$old->id}}">
        <input type="hidden" name="balance_code" v-model="code_balance">
        <input type="hidden" name="large_code" v-model="code_large">
        <input type="hidden" name="middle_code" v-model="code_middle">
        <input type="hidden" name="small_code" v-model="code_small">
      </form>
    </div>
  </div><!--row-->
<script type="text/javascript" src="{{ URL::asset('js/201_input_book.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>
</html>