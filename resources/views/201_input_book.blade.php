@extends('layouts.common_base')

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
    @switch($processmode)
      @case(Config::get('processmode.input'))
        <form action="input_book" method="post" id="form" >
        @break
      @case(Config::get('processmode.update'))
        <form action="edit_book" method="post" id="form" >
        @break
    @endswitch
      @csrf
      {{-- 日付 --}}
      　<div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="category_balance" class="txt-itemname" >日付</label>
            <input type="text" name="pay_day" class="form-control datetimepicker-input"
              id="datetimepicker" data-toggle="datetimepicker" data-target="#datetimepicker"
            />
          </div>
        </div>
        {{-- 収支 --}}
        <div class="row" >
          <div class="container col-md-10 offset-md-1">
            <label for="category_balance"　class="txt-itemname">収支</label>
            <select name="category_balance" class="form-control" 
            id="category_balance" v-model="category_balance">
              <option v-for="item in json_balance" v-bind:value="item.code">@{{item.name}}</option>
          </select>
          </div>
        </div>
        {{-- 大分類 --}}
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="category_large"　class="txt-itemname">大分類</label>
            <select name="category_large" class="form-control" id="category_large" v-model="category_large">
              <option v-for="item in json_large" v-bind:value="item.code">@{{item.name}}</option>
          </select>
          </div>
        </div>
        {{-- 中分類 --}}
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="category_middle"　class="txt-itemname">中分類</label>
            <select name="category_middle"  class="form-control" id="category_middle" v-model="category_middle">
              <option v-for="item in json_middle" v-bind:value="item.code">@{{item.name}}</option>
          </select>
          </div>
        </div>
        {{-- 小分類 --}}
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="category_small"　class="txt-itemname">小分類</label>
            @if($errors->has('category_small'))
              @foreach($errors->get('category_small') as $error)
              <p class="txt-error">{{$error}}</p>
              @endforeach
            @endif
            <select name="category_small" class="form-control" id="category_small" v-model="category_small">
            <option v-for="item in json_small" v-bind:value="item.code">@{{item.name}}</option>
          </select>
          </div>
        </div>
        {{-- メモ --}}
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="memo"　class="txt-itemname">メモ</label>
            <input type="text" name="memo" class="form-control" id="memo" v-model="memo">
          </select>
          </div>
        </div>
        {{-- 金額 --}}
        <div class="row">
          <div class="container col-md-10 offset-md-1">
            <label for="payment"　class="txt-itemname">金額</label>
            @if($errors->has('payment'))
              @foreach($errors->get('payment') as $error)
              <p class="txt-error">{{$error}}</p>
              @endforeach
            @endif
            <input type="text" id="payment"  name="payment" class="form-control" 
            v-model="payment">
          </div>
        </div>
        <div class="row mt-5">
          <div class="container col-6 col-md-offset-1 mb-5">
          @switch($processmode)
            @case(Config::get('processmode.input'))
              <input type="submit" class="btn-lg btn-block btn-primary" value="書き込む">
              @break
            @case(Config::get('processmode.update'))
            <input type="submit" class="btn-lg btn-block btn-primary" value="更新する">
              @break
          @endswitch
          </div>
        </div>
        @if($processmode == Config::get('processmode.input'))
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
      $(function () {
          $('#datetimepicker').datetimepicker({
              locale: 'ja',
              dayViewHeaderFormat: 'YYYY年 M月',
              format: 'YYYY-MM-DD',
              viewMode:'days',
              defaultDate:new Date()
          });
      });
  </script>
@endsection