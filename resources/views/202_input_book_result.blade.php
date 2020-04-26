@extends('layouts.common_base')

@section('navbar-current')
  @switch($processmode)
    @case(Config::get('processmode.input'))
      <span class="navbar-text text-warning">新規入力確認<span>
      @break
    @case(Config::get('processmode.update'))
      <span class="navbar-text text-warning">編集結果<span>
      @break
  @endswitch
@endsection

@section('navbar-menu')
  <a class="nav-item nav-link" href="./input_book">家計簿をつける</a>
  <a class="nav-item nav-link" href="./read_book">家計簿を見る</a>
  <a class="nav-item nav-link" href="./read_book_aggregate?table_name=category_balance">年表を見る</a>
@endsection

@section('contents')
  <div class="row mtpx-100">
    <div class="card col-md-12 container">
      <table class="table">
        <thead class="table-light">
          <tr>
            <th class="col-xs-2">項目</th>
            <th class="col-xs-10">入力値</th>
          </tr>
        </thead>
        <tbody  class="table-dark">
        @switch($processmode)
          @case(Config::get('processmode.input'))
            <tr> <td>日付</td><td>{{$today}}</td> </tr>
            @break
          @case(Config::get('processmode.update'))
            <tr> <td>日付</td><td>{{$request->pay_day}}</td> </tr>
          @break
        @endswitch
          <tr> <td>収支</td><td>{{$request->category_balance}}</td> </tr>
          <tr> <td>大分類</td><td>{{$request->category_large}}</td> </tr>
          <tr> <td>中分類</td><td>{{$request->category_middle}}</td> </tr>
          <tr> <td>小分類</td><td>{{$request->category_small}}</td> </tr>
          <tr> <td>メモ</td><td>{{$request->memo}}</td> </tr>
          <tr> <td>金額</td><td class="txt-currency">{{$request->payment}}</td> </tr>
        </tbody>
      </table>
    </div>
  </div>
  
  {{-- ボタン部 --}}
  <div class="container col-md-8 col-md-offset-2 mt-5">
    <button type="button" onclick="location.href='input_book'" class="btn btn-primary">続けて記入</button>
    <button type="button" onclick="location.href='index.php'" class="btn btn-primary">ホームへ</button>      
  </div>
@endsection 

@section('footer_load_css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
@endsection

@section('footer_load_javascript')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection