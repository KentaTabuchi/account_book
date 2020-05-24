@extends('layouts.system_base')

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
              <p class="txt-message text-center">{{Config::get('messages.input_comfirm')}}</p>
          </div>
          @break
        @case(Config::get('processmode.update'))
          <div class="my-3 pt-4 pb-3 panel-message">
            <p class="txt-message text-center">{{Config::get('messages.update_comfirm')}}</p>
          </div>
          @break
        @case(Config::get('processmode.delete'))
          <div class="my-3 pt-4 pb-3 panel-message">
              <p class="txt-message text-center">{{Config::get('messages.delete_comfirm')}}</p>
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
          @if($processmode == Config::get('processmode.update') ||
                $processmode == Config::get('processmode.detail'))
            <tr>
              <td>分類コード</td>
              <td>{{$category->code}}</td>
            </tr>
          @endif
          <tr>
            <td>所属する親分類</td>
            <td>{{$category->parent_name}}</td>
          </tr>
          <tr>
            <td>分類名</td>
            <td>{{$category->name}}</td>
          </tr>
        </tbody>
      </table>
      {{-- ボタン部 --}}
      <div class="my-3 py-3 panel-button-group">
      @switch($processmode)
        @case(Config::get('processmode.detail'))
          <div class="mx-auto" style="width:500px;">
          @switch($category_mode)
            @case(Config::get('categorymode.middle'))
              <button type="button" 
                onclick="location.href='manage_category?category_mode={{Config::get('categorymode.middle')}}'" 
                class="btn btn-light">一覧へ戻る</button>
              @break
            @case(Config::get('categorymode.small'))
              <button type="button" 
                onclick="location.href='manage_category?category_mode={{Config::get('categorymode.small')}}'" 
                class="btn btn-light">一覧へ戻る</button>
              @break
          @endswitch
            <button type="button" onclick="location.href='system_menu'" class="btn btn-light">システムメニューへ</button>
            <button type="button" onclick="location.href='edit_book?id={{$category->code}}'" class="btn btn-light">編集する</button>
            <button type="button" onclick="location.href='comfirm_delete?code={{$category->code}}&category_mode={{$category_mode}}'" class="btn btn-light">削除する</button>
          </div>
          @break
        @case(Config::get('processmode.input'))
          <div class="mx-auto" style="width:400px;">
              <form action="back_input" method="post" id="update_back_form" style="display:inline">
                @csrf
                <input type="submit" class="btn btn-light" value="入力へ戻る">
                <input type="hidden" name="hidden_request" value="{{$category}}">
              </form>
              <form action="comfirm_category" method="post" id="update_form" style="display:inline">
                @csrf
                <input type="submit" class="btn btn-light" value="登録する">
                <input type="hidden" name="hidden_request" value="{{$category}}">
                <input type="hidden" name="category_mode" value="{{$category_mode}}">
              </form>
            </div>
            @break
        @case(Config::get('processmode.update'))
          <div class="mx-auto" style="width:400px;">
            <form action="back_update" method="post" id="update_back_form" style="display:inline-block">
              @csrf
              <input type="submit" class="btn btn-light" value="編集へ戻る">
              <input type="hidden" name="hidden_request" value="{{$category}}">
            </form>
            <form action="comfirm_update" method="post" id="update_form" style="display:inline-block">
              @csrf
              <input type="submit" class="btn btn-light" value="変更する">
              <input type="hidden" name="hidden_request" value="{{$category}}">
            </form>
          </div>
          @break
        @case(Config::get('processmode.delete'))
          <div class="mx-auto" style="width:400px;">
            <form action="comfirm_delete" method="post" id="form" >
            @csrf
              <button type="button" onclick="location.href='comfirm_category?code={{$category->code}}'" class="btn btn-light">詳細へ戻る</button>
              <input type="submit" class="btn btn-light" value="削除する">
              <input type="hidden" name="hidden_request" value="{{$category}}">
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