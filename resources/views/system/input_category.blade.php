@extends('layouts.system_base')

@section('load_javascript')
  <!--datePicker関連-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/css/tempusdominus-bootstrap-4.min.css" />
  <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js" integrity="sha384-0pzryjIRos8mFBWMzSSZApWtPl/5++eIfzYmTgBBmXYdhvxPc+XcFEk+zJwDgWbP" crossorigin="anonymous"></script>
@endsection

@section('navbar-current')
  @switch($processmode)
    @case(Config::get('processmode.input'))
      <span class="navbar-text text-warning">新規入力<span>
      @break
    @case(Config::get('processmode.update'))
      <span class="navbar-text text-warning">編集<span>
      @break
  @endswitch
@endsection

@section('navbar-menu')
  <a class="nav-item nav-link" href="./read_book">家計簿を見る</a>
  <a class="nav-item nav-link" href="./read_book_aggregate?table_name=category_balance">年表を見る</a>
@endsection

@section('contents')
  <div class="row　justify-content-around mtpx-100">
    <div class="container col-md-10 offset-md-1 col-lg-4 card bg-light" id="input_form">
    <h1>{{Config::get('categoryname.'.$category_mode)}}</h1>
    @switch($processmode)
      @case(Config::get('processmode.input'))
        <form action="input_category" method="post" id="form">
        @break
      @case(Config::get('processmode.update'))
        <form action="edit_category" method="post" id="form">
        @break
    @endswitch
      @csrf
      {{-- 分類名 --}}
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="memo"　class="txt-itemname">分類名</label>
            <input type="text" name="category_name" class="form-control">
          </div>
        </div>
        @switch($category_mode)
          @case(Config::get('categorymode.middle'))
            {{-- 大分類 --}}
            <div class="row">
              <div class="container col-md-10 offset-md-1">
                <label for="category_large"　class="txt-itemname">大分類</label>
                <select name="category_large" class="form-control" id="category_large">
                  @foreach($parents_list as $item)
                    <option value="{{$item->code}}">{{$item->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            @break
          @case(Config::get('categorymode.small'))
            {{-- 中分類 --}}
            <div class="row">
              <div class="container col-md-10 offset-md-1">
                <label for="category_middle"　class="txt-itemname">中分類</label>
                <select name="category_middle" class="form-control" id="category_middle">
                  @foreach($parents_list as $item)
                    <option value="{{$item->code}}">{{$item->name}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            @break
        @endswitch
        {{-- ボタン部 --}}
        <div class="my-3 py-3 panel-button-group">
          <div class="mx-auto" style="width:250px;">
          @switch($processmode)
            @case(Config::get('processmode.input'))
              <button type="button" onclick="location.href='index.php'" class="btn btn-light">戻る(工事中)</button>
              <input type="submit" class="btn btn-light" value="確認へ進む">
              @break
            @case(Config::get('processmode.update'))
              <button type="button" onclick="location.href='comfirm_receipt?id={{$request->id}}'" class="btn btn-light">詳細へ戻る</button>
              <input type="submit" class="btn btn-light" value="確認へ進む">
              @break
          @endswitch
          </div>
        </div>
          <input type="hidden" value="{{$processmode}}" name="process_mode">
          <input type="hidden" value="{{$category_mode}}" name="category_mode">
        @if($processmode == Config::get('processmode.update'))
          <input type="hidden" name="id" v-model="id">
        @endif
      </form>
    </div>
  </div>
@endsection

@section('footer_load_css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
@endsection

@section('footer_load_javascript')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/locale/ja.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.1.2/js/tempusdominus-bootstrap-4.min.js"></script>
  <script type="text/javascript" src="{{ URL::asset('js/201_input_book.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript">

@endsection