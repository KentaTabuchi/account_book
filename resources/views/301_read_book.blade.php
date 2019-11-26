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
    <div class="container col-md-8 justify-content-around">
        <h4>一覧表</h4>
        <table class="table table-dark col-xs-10 col-md-12 offset-1" data-toggle="table" data-pagination="true">
          <thead class="thead-light">
          <tr>
            <th  class="d-none d-md-table-cell" data-sortable="true">日付</th>
            <th class="d-none d-md-table-cell" data-sortable="true">収支</th>
            <th class="d-none d-md-table-cell" data-sortable="true" class="d-none d-md-table-cell">大分類</th>
            <th class="d-none d-md-table-cell" data-sortable="true">中分類</th>
            <th data-sortable="true">小分類</th>
            <th>メモ</th>
            <th data-sortable="true">金額</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($record as $item)
          <tr>
            <td class="d-none d-md-table-cell">{{$item->pay_day}}</td>
            <td>{{$item->balance_name}}</td>
            <td class="d-none d-md-table-cell">{{$item->large_name}}</td>
            <td>{{$item->middle_name}}</td>
            <td>{{$item->small_name}}</td>
            <td>{{$item->memo}}</td>
            <td>{{$item->payment}}</td>
          </tr>         
          @endforeach

          </tbody>
        </table>
    </div>

  </div><!--row-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
</body>
</html>