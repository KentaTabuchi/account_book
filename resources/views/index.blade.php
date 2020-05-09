@extends('layouts.common_base')

@section('load_javascript')
  <!--chart.js-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
  <!--axios-->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
@endsection

@section('navbar-current')
  <span class="navbar-text text-warning">ホーム<span>
@endsection

@section('navbar-menu')
  <a class="nav-item nav-link" href="./input_book">家計簿をつける</a>
  <a class="nav-item nav-link" href="./read_book">家計簿を見る</a>
  <a class="nav-item nav-link" href="./read_book_aggregate?table_name=category_balance">年表を見る</a>
@endsection

@section('contents')
  <div class="container col-xs-12 mtpx-100">
    <div class="row"><!--container-->
        <div class="pnl-img col-md-10 col-md-offset-1 container">
          <img src="images/index/money_kakeibo_ase.png">
          <p>家計簿をつける</p>
          <a href="./input_book"></a>
        </div>
        <div class="pnl-img col-md-10 col-md-offset-1 container">
          <img src="images/index/bunbougu_note.png">
          <p>家計簿を見る</p>
          <a href="./read_book"></a>
        </div>
        <div class="pnl-img col-md-10 col-md-offset-1 container">
          <img src="images/index/document_report.png">
          <p>年表を見る</p>
          <a href="./read_book_aggregate?table_name=category_balance"></a>
        </div>
        <div class="pnl-img col-md-10 col-md-offset-1 container">
          <img src="images/index/money_kounetsuhi.png">
          <p>固定費年表</p>
          <a href="./input_monthly_cost"></a>
        </div>
        <div class="pnl-img col-md-10 col-md-offset-1 container">
          <img src="images/index/mokuhyou5_kongetsu.png">
          <p>予算の設定</p>
          <a href="edit_budget?"></a>
        </div>
        <div class="pnl-img col-md-10 col-md-offset-1 container">
          <img src="images/index/haguruma_gear_set_rittai.png">
          <p>システム設定</p>
          <a href="system/system_menu"></a>
        </div>
    </div>
    <div class="container col-md-5 mtpx-50 mb-5">
    <canvas id="myChart" class="col-12" width="10" height="10"></canvas>
    </div>
  </div>
@endsection

@section('footer_load_javascript')
  <script src="js/101_index.js"></script>
@endsection

