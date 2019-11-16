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
        <title>家計簿</title>
    </head>

<body>
  <div class="row">
    <div class="container col-md-8 col-md-offset-2">
        <h4>記入</h4>
    </div>
  </div><!--row-->
  <div class="row">
    <div class="container col-md-8 col-md-offset-2">
      <form>
      @csrf
        <div class="row">
          <div class="col-6">
            <label for="category_balance">収支</label>
            <select class="form-control" id="category_balance">
            @foreach($category_balance as $item)
              <option>{{$item->name}}</option>
            @endforeach
          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="col-6">
            <label for="category_large">大分類</label>
            <select class="form-control" id="category_large">
            @foreach($category_large as $item)
              <option>{{$item->name}}</option>
            @endforeach
          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="col-6">
            <label for="category_middle">中分類</label>
            <select class="form-control" id="category_middle">
            @foreach($category_middle as $item)
              <option>{{$item->name}}</option>
            @endforeach
          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="col-6">
            <label for="category_small">小分類</label>
            <select class="form-control" id="category_small">
            @foreach($category_small as $item)
              <option>{{$item->name}}</option>
            @endforeach
          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="col-6">
            <label for="category_balance">メモ</label>
            <input type="text" class="form-control" id="category_balance">

          </select>
          </div>
        </div><!--row-->
        <div class="row">
          <div class="col-3">
            <label for="payment">支払額</label>
            <input type="text" id="payment" class="form-control">
          </div>
        </div><!--row-->
        <div class="row mt-5">
          <div class="container col-10 col-md-offset-1">
            <input type="submit" class="btn btn-block btn-primary" value="家計簿に書き込む">
          </div>
        </div><!--row-->
      </form>
    </div>
  </div><!--row-->
</body>
</html>