@extends('layouts.system_base')

@section('load_javascript')
@endsection

@section('navbar-current')
  <span class="navbar-text text-warning">システムメニュー<span>
@endsection

@section('navbar-menu')
  <a class="nav-item nav-link" href="/input_book">家計簿をつける</a>
  <a class="nav-item nav-link" href="/read_book">家計簿を見る</a>
  <a class="nav-item nav-link" href="/read_book_aggregate?table_name=category_balance">年表を見る</a>
@endsection

@section('contents')
<div class="container col-xs-12 mtpx-100">
  <h1>{{Config::get('categoryname.'.$category_mode)}}</h1>

  <div class="form-group">
    <form method="post" action="find_category">
      @csrf
      {{-- 項目名 --}}
      <label for="item_title" class="txt-itemname">項目名</label>
      <input type="text" name="item_title" class="form-control col-6">
      {{-- 選択中の項目の上位分類 --}}
      <label for="parent_category" class="txt-itemname">所属する親分類</label>
      <select name="parent_category" class="form-control col-6">
        @foreach($parents_list as $parents)
          <option value="{{$parents->code}}">{{$parents->name}}</option>
        @endforeach
      </select>

      {{-- ボタンブロック --}}
      <div class="mt-3">
        {{--　検索ボタン --}}
        <input type="submit" value="検索" class="btn btn-dark">
        {{--　追加ボタン --}}
        <button type="button" class="btn btn-dark" 
          onclick="location.href='input_category?category_mode={{$category_mode}}'">新規追加</button>
        <input type="hidden" name="category_mode" value="{{$category_mode}}">
      </div>
    </form>
    {{--　区切り線 --}}
    <hr style="height:5px; background-color:brown">
    
    {{-- 現在登録されているリスト --}}
    <table class="table table-dark" data-toggle="table" data-pagination="true">
      <thead>
        <th>コード</th>
        <th>項目名</th>
        <th>親分類</th>
        <th>詳細</th>
      </thead>
      <tbody>
        @foreach($current_list as $current)
        <tr>
          <td>{{$current->code}}</td>
          <td>{{$current->name}}</td>
          @switch($category_mode)
            @case(Config::get('categorymode.large'))
              <td>{{$current->category_balance->name}}</td>
              @break
            @case(Config::get('categorymode.middle'))
              <td>{{$current->category_large->name}}</td>
              @break
            @case(Config::get('categorymode.small'))
            <td>{{$current->category_middle->name}}</td>
              @break
          @endswitch
          <td>
            <button type="button" 
              onclick="location.href='comfirm_category?code={{$current->code}}&category_mode={{$category_mode}}'">
              詳細</button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="col-xs-10 col-md-10 offset-1">
          {{$current_list->appends(['page_size'=>$page_size,'category_mode'=>$category_mode])->links()}}
        </div>
  </div>
</div>
@endsection

@section('footer_load_javascript')
@endsection

