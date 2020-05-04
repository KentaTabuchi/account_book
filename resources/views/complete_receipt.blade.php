@extends('layouts.common_base')

@section('navbar-current')
  @switch($processmode)
    @case(Config::get('processmode.input'))
      <span class="navbar-text text-warning">新規入力完了<span>
      @break
    @case(Config::get('processmode.update'))
      <span class="navbar-text text-warning">編集結果完了<span>
      @break
    @case(Config::get('processmode.delete'))
      <span class="navbar-text text-warning">削除完了<span>
      @break
    @case(Config::get('processmode.detail'))
      <span class="navbar-text text-warning">詳細完了<span>
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
    {{-- メッセージ部 --}}
      <div class="my-3 pt-4 pb-3 panel-message">
        <div class="container col-md-4 col-md-offset-8">
      @switch($processmode)
        @case(Config::get('processmode.input'))
            <p class="txt-message">{{Config::get('messages.input_complete')}}</p>
          @break
        @case(Config::get('processmode.update'))
            <p class="txt-message">{{Config::get('messages.update_complete')}}</p>
          @break
      @endswitch
        </div>
      </div>
      
      {{-- ボタン部 --}}
      <div class="my-3 py-3 panel-button-group">
      @switch($processmode)
        @case(Config::get('processmode.detail'))
          <div class="container col-md-4 col-md-offset-8">
            <button type="button" onclick="location.href='read_book'" class="btn btn-light">一覧へ戻る</button>
            <button type="button" onclick="location.href='index.php'" class="btn btn-light">ホームへ</button>
            <button type="button" onclick="location.href='edit_book?id={{$receipt->id}}'" class="btn btn-light">編集する</button>
            <button type="button" onclick="location.href='index.php'" class="btn btn-light">削除する</button>
          </div>
          @break
        @case(Config::get('processmode.update'))
        <div class="container col-md-4 col-md-offset-8">
          <form action="comfirm_update" method="post" id="form" >
          @csrf
            <button type="button" onclick="location.href='index.php'" class="btn btn-light">ホームへ</button>
            <button type="button" onclick="location.href='read_book'" class="btn btn-light">編集へ戻る</button>
            <input type="submit" class="btn btn-light" value="変更する">
            <input type="hidden" name="hidden_request" value="{{$receipt}}">
          </form>
        </div>
        @break
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