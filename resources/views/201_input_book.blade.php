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
        <title>家計簿</title>
    </head>

<body>
  <div class="row">
    <div class="container col-md-8 col-md-offset-2">
        <h4>記入</h4>
    </div>
  </div><!--row-->
  <div class="row">
    <div class="container col-md-10 col-md-offset-2 card" id="input_form">
      <form action="input_book" method="post" id="form" >
      @csrf
        <div class="row" >
          <div class="container col-6 col-md-offset-2">
            <pre>@{{$data}}</pre>

            <label for="category_balance">収支</label>
            <select name="category_balance" class="form-control" id="category_balance" v-model="category_balance">
              <option v-for="item in json_balance">@{{item.name}}</option>
          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="container col-6 col-md-offset-2">
            <label for="category_large">大分類</label>
            <select name="category_large" class="form-control" id="category_large" v-model="category_large">
              <option v-for="item in json_large">@{{item.name}}</option>
          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="container col-6 col-md-offset-2">
            <label for="category_middle">中分類</label>
            <select name="category_middle"  class="form-control" id="category_middle" v-model="category_middle">
              <option v-for="item in json_middle">@{{item.name}}</option>
          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="container col-6 col-md-offset-2">
            <label for="category_small">小分類</label>
            <select name="category_small" class="form-control" id="category_small" v-model="category_small">
              <option v-for="item in json_small">@{{item.name}}</option>
          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="container col-6 col-md-offset-2">
            <label for="category_balance">メモ</label>
            <input type="text"  name="memo" class="form-control" id="category_balance" v-model="memo">
          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="container col-6 col-md-offset-2">
            <label for="payment">支払額</label>
            <input type="text" id="payment"  name="payment" class="form-control" v-model="payment">
          </div>
        </div><!--row-->
        <div class="row mt-5">
          <div class="container col-10 col-md-offset-1 mb-5">
            <input type="submit" class="btn btn-block btn-primary" value="家計簿に書き込む">
          </div>
        </div><!--row-->
        <input type="hidden" name="changed_form" v-model="changed_form">
      </form>
    </div>
  </div><!--row-->
<script type="text/javascript" src="{{ URL::asset('js/201_input_book.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>
</html>