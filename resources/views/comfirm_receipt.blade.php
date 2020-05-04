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
      <span class="navbar-text text-warning">詳細閲覧<span>
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
    {{-- 上部メッセージ部 --}}
    @switch($processmode)
        @case(Config::get('processmode.input'))
          <div class="my-3 pt-4 pb-3 panel-message">
            <div class="container col-md-4 col-md-offset-8">
              <p class="txt-message">{{Config::get('messages.input_comfirm')}}</p>
            </div>
          </div>
          @break
        @case(Config::get('processmode.update'))
          <div class="my-3 pt-4 pb-3 panel-message">
            <div class="container col-md-4 col-md-offset-8">
              <p class="txt-message">{{Config::get('messages.update_comfirm')}}</p>
            </div>
          </div>
          @break
        @case(Config::get('processmode.delete'))
          <div class="my-3 pt-4 pb-3 panel-message">
            <div class="container col-md-4 col-md-offset-8">
              <p class="txt-message">{{Config::get('messages.delete_comfirm')}}</p>
            </div>
          </div>
          @break
      @endswitch
      
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
          @if($processmode == Config::get('processmode.update') ||
                $processmode == Config::get('processmode.detail'))
            <tr> <td>ID</td><td>{{$receipt->id}}</td> </tr>
          @endif
          <tr> <td>収支</td><td>{{$receipt->balance_name}}</td> </tr>
          <tr> <td>大分類</td><td>{{$receipt->large_name}}</td> </tr>
          <tr> <td>中分類</td><td>{{$receipt->middle_name}}</td> </tr>
          <tr> <td>小分類</td><td>{{$receipt->small_name}}</td> </tr>
          <tr> <td>メモ</td><td>{{$receipt->memo}}</td> </tr>
          <tr> <td>金額</td><td class="txt-currency">{{$receipt->payment}}</td></tr>
        </tbody>
      </table>
      {{-- ボタン部 --}}
      <div class="my-3 py-3 panel-button-group">
      @switch($processmode)
        @case(Config::get('processmode.detail'))
          <div class="container col-md-4 col-md-offset-8">
            <button type="button" onclick="location.href='read_book'" class="btn btn-light">一覧へ戻る</button>
            <button type="button" onclick="location.href='index.php'" class="btn btn-light">ホームへ</button>
            <button type="button" onclick="location.href='edit_book?id={{$receipt->id}}'" class="btn btn-light">編集する</button>
            <button type="button" onclick="location.href='comfirm_delete?id={{$receipt->id}}'" class="btn btn-light">削除する</button>
          </div>
          @break
        @case(Config::get('processmode.input'))
          <div class="container col-md-4 col-md-offset-8">
            <form action="back_input" method="post" id="update_back_form" style="display:inline">
              @csrf
              <input type="submit" class="btn btn-light" value="入力へ戻る(未完)">
              <input type="hidden" name="hidden_request" value="{{$receipt}}">
            </form>
            <form action="comfirm_input" method="post" id="update_form" style="display:inline">
              @csrf
              <input type="submit" class="btn btn-light" value="登録する">
              <input type="hidden" name="hidden_request" value="{{$receipt}}">
            </form>
          </div>
          @break
        @case(Config::get('processmode.update'))
        <div class="container col-md-4 col-md-offset-8">
          <form action="back_update" method="post" id="update_back_form" style="display:inline">
            @csrf
            <input type="submit" class="btn btn-light" value="編集へ戻る">
            <input type="hidden" name="hidden_request" value="{{$receipt}}">
          </form>
          <form action="comfirm_update" method="post" id="update_form" style="display:inline">
            @csrf
            <input type="submit" class="btn btn-light" value="変更する">
            <input type="hidden" name="hidden_request" value="{{$receipt}}">
          </form>
        </div>
        @break
        @case(Config::get('processmode.delete'))
        <div class="container col-md-4 col-md-offset-8">
          <form action="comfirm_delete" method="post" id="form" >
          @csrf
            <button type="button" onclick="location.href='comfirm_receipt?id={{$receipt->id}}'" class="btn btn-light">詳細へ戻る</button>
            <input type="submit" class="btn btn-light" value="削除する">
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