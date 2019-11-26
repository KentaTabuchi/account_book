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
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.css">
<script src="https://unpkg.com/bootstrap-table@1.15.5/dist/bootstrap-table.min.js"></script>
    <!-- Vue.jsのJS読み込み -->    
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
    <meta name="viewport" content="width=device-width">
        <title>家計簿</title>
    </head>
<body>
  <div class="row">
    <div class="container col-md-10 ml-5">
        <h4>一覧表 {{$year}}年</h4>
        <div class="row mb-1">
          <button class="btn btn-danger col-2" onclick='location.href="./read_book_aggregate?table_name=category_balance"'>収支別</button>
          <button class="btn btn-danger col-2" onclick='location.href="./read_book_aggregate?table_name=category_large"'>大分類</button>
          <button class="btn btn-danger col-2" onclick='location.href="./read_book_aggregate?table_name=category_middle"'>中分類</button>
          <button class="btn btn-danger col-2" onclick='location.href="./read_book_aggregate?table_name=category_small"'>小分類</button>
          <form>
            <input type="hidden" id= "oldYear" value={{$year}}>
          </form>
          <select id="year"class="col-2">
            <option value="2015">2015</option>
            <option value="2016">2016</option>
            <option value="2017">2017</option>
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            <option value="2026">2026</option>
            <option value="2027">2027</option>
            <option value="2028">2028</option>
            <option value="2029">2029</option>
            <option value="2030">2030</option>
        </select>
        </div><!--row-->
        <div class="row">
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
          @foreach ($record_set as $record)
          <tr>
            <td>{{$record['name']}}</td><!--費目-->
            <td>{{$record['m1']}}</td><!--1月-->
            <td>{{$record['m2']}}</td><!--2月-->
            <td>{{$record['m3']}}</td><!--3月-->
            <td>{{$record['m4']}}</td><!--4月-->
            <td>{{$record['m5']}}</td><!--5月-->
            <td>{{$record['m6']}}</td><!--6月-->
            <td>{{$record['m7']}}</td><!--7月-->
            <td>{{$record['m8']}}</td><!--8月-->
            <td>{{$record['m9']}}</td><!--9月-->
            <td>{{$record['m10']}}</td><!--10月-->
            <td>{{$record['m11']}}</td><!--11月-->
            <td>{{$record['m12']}}</td><!--12月-->
          </tr>         
          @endforeach
          </tbody>
        </table>
        <div>
    </div><!--container-->

  </div><!--row-->
<script type="text/javascript" src="{{ URL::asset('js/302_read_book_aggregate.js')}}"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>
</html>