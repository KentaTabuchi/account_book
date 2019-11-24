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
        <title>家計簿</title>
    </head>

<body>
  <div class="row">
    <div class="container col-md-8 col-md-offset-2">
        <h4>一覧表</h4>
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
          @foreach ($record as $item)
          <tr>
            <td></td><!--費目-->
            <td></td><!--1月-->
            <td></td><!--2月-->
            <td></td><!--3月-->
            <td></td><!--4月-->
            <td></td><!--5月-->
            <td></td><!--6月-->
            <td></td><!--7月-->
            <td></td><!--8月-->
            <td></td><!--9月-->
            <td></td><!--10月-->
            <td></td><!--11月-->
            <td></td><!--12月-->
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