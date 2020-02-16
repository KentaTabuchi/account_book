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
  <!--datePicker関連-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" />
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>
  <!--自作CSS-->  
  <link href="css/custom.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width">
  <title>家計簿</title>
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="index.php"><img src="images/common/home_icon.png" class="nav-homeicon bg-white"><a>
    <span class="navbar-text text-warning">新規記入<span>
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

  <div class="row mtpx-100">
    <div class="container col-md-10 ml-5">
    <form action="input_monthly_cost" method="post" id="form" >
      @csrf
      <h1>{{$year}}年&nbsp;固定費表</h1>
      <input type="submit" value="更新する" class="btn btn-primary col-1"/>
      <table class="table table-dark" data-toggle="table" data-pagination="true">
        <thead class="thead-light">
          <tr>
            <th>費目</th>
            <th>1月</th>
            <th>2月</th>
            <th>3月</th>
            <th>4月</th>
            <th>5月</th>
            <th>6月</th>
            <th>7月</th>
            <th>8月</th>
            <th>9月</th>
            <th>10月</th>
            <th>11月</th>
            <th>12月</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($valuesList as $values)
          <tr>
          <td>{{$values['name']}}</td>

            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m1" value={{$values['m_1']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m2" value={{$values['m_2']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m3" value={{$values['m_3']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m4" value={{$values['m_4']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m5" value={{$values['m_5']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m6" value={{$values['m_6']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m7" value={{$values['m_7']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m8" value={{$values['m_8']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m9" value={{$values['m_9']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m10" value={{$values['m_10']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m11" value={{$values['m_11']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m12" value={{$values['m_12']}}></td>
   
          </tr>
          @endforeach
        </tbody>
      </table>
      <input type="hidden" value="{{$year}}" name="year"/>
      </form>
    </div>
  </div>

  <script src="{{ URL::asset('/js/app.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>