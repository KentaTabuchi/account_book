@extends('layouts.system_base')

@section('navbar-current')

      <span class="navbar-text text-warning">新規入力エラー<span>

@endsection

@section('navbar-menu')
  <a class="nav-item nav-link" href="./input_book">家計簿をつける</a>
  <a class="nav-item nav-link" href="./read_book">家計簿を見る</a>
  <a class="nav-item nav-link" href="./read_book_aggregate?table_name=category_balance">年表を見る</a>
@endsection

@section('contents')
  <div class="row mtpx-100">
    <div class="card col-md-10 container">
    {{-- メッセージ部 --}}
      <div class="my-3 pt-4 pb-3 panel-message">
          <p class="txt-message text-center">{{$error_message}}</p>
      </div>
      
      {{-- ボタン部 --}}
      <div class="my-3 py-3 panel-button-group">
          <div class="mx-auto" style="width:300px;">
            <button type="button" onclick="location.href='system_menu'" class="btn btn-light">メニューへ戻る</button>
          </div>
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