@extends('layouts.common_base')

@section('navbar-current')
  @switch($processmode)
    @case(Config::get('processmode.input'))
      <span class="navbar-text text-warning">新規入力確認<span>
      @break
    @case(Config::get('processmode.update'))
      <span class="navbar-text text-warning">編集結果確認<span>
      @break
    @case(Config::get('processmode.delete'))
      <span class="navbar-text text-warning">削除確認<span>
      @break
    @case(Config::get('processmode.detail'))
      <span class="navbar-text text-warning">詳細確認<span>
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
    <div class="card col-md-10 container">
      <table class="table">
        <thead class="table-light">
          <tr>
            <th class="col-xs-1">項目</th>
            <th class="col-xs-11">入力値</th>
          </tr>
        </thead>
        <tbody class="table-dark">
        @switch($processmode)
          @case(Config::get('processmode.input'))
            <tr> <td>日付</td><td>{{$today}}</td> </tr>
            @break
          @case(Config::get('processmode.update') || Config::get('processmode.detail'))
            <tr> <td>日付</td><td>{{$receipt->pay_day}}</td> </tr>
          @break
        @endswitch
          <tr> <td>ID</td><td>{{$receipt->id}}</td> </tr>
          <tr> <td>収支</td><td>{{$receipt->balance_name}}</td> </tr>
          <tr> <td>大分類</td><td>{{$receipt->large_name}}</td> </tr>
          <tr> <td>中分類</td><td>{{$receipt->middle_name}}</td> </tr>
          <tr> <td>小分類</td><td>{{$receipt->small_name}}</td> </tr>
          <tr> <td>メモ</td><td>{{$receipt->memo}}</td> </tr>
          <tr> <td>金額</td><td class="txt-currency">{{$receipt->payment}}</td> </tr>
        </tbody>
      </table>
      {{-- ボタン部 --}}
      <div class="my-3 py-3 panel-button-group">
      @switch($processmode)
      @case(Config::get('processmode.detail'))
        <div class="container col-md-4 col-md-offset-8">
          <button type="button" onclick="location.href='read_book'" class="btn btn-light">一覧へ戻る</button>
          <button type="button" onclick="location.href='index.php'" class="btn btn-light">ホームへ</button>
          <button type="button" onclick="location.href='edit_book'" class="btn btn-light">編集する</button>
          <button type="button" onclick="location.href='index.php'" class="btn btn-light">削除する</button>
        </div>
      @endswitch
      </div>
    </div>
  </div>
  

@endsection 

@section('footer_load_css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
@endsection

@section('footer_load_javascript')
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection