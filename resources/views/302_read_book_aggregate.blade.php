@extends('layouts.common_base')

@section('navbar-current')
  <span class="navbar-text text-warning">集計表<span>
@endsection

@section('navbar-menu')
  <a class="nav-item nav-link" href="./input_book">家計簿をつける</a>
  <a class="nav-item nav-link" href="./read_book">家計簿を見る</a>
@endsection

@section('contents')
  <div class="row mtpx-100">
    <div class="container col-md-10 ml-5">
        <h4>一覧表 {{$year}}年</h4>
        <div class="row mb-1">
          <button class="btn btn-danger col-2" onclick='location.href="./read_book_aggregate?table_name=category_balance"'>収支別</button>
          <button class="btn btn-danger col-2" onclick='location.href="./read_book_aggregate?table_name=category_large"'>大分類</button>
          <button class="btn btn-danger col-2" onclick='location.href="./read_book_aggregate?table_name=category_middle"'>中分類</button>
          <button class="btn btn-danger col-2" onclick='location.href="./read_book_aggregate?table_name=category_small"'>小分類</button>
          <form>
          <input type="hidden" id= "oldYear" value={{$year}}>
          </form>
          <div id="app">
            <select-year></select-year>
          </div>
        </div><!--row-->
        <div class="row">
        <table class="table table-dark" data-toggle="table" data-pagination="true">
          <thead class="thead-light">
          <tr>
            <th>費目</th>
            <th>1月</th>
            <th>2月</th>
            <th>3月</th>
            <th>4月</th>
            <th>5月</th>
            <th>6月</th>
            <th>7月</th>
            <th>8月</th>
            <th>9月</th>
            <th>10月</th>
            <th>11月</th>
            <th>12月</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($record_set as $record)
          <tr>
            <td>{{$record['name']}}</td><!--費目-->
            <td>{{$record['m1']}}</td><!--1月-->
            <td>{{$record['m2']}}</td><!--2月-->
            <td>{{$record['m3']}}</td><!--3月-->
            <td>{{$record['m4']}}</td><!--4月-->
            <td>{{$record['m5']}}</td><!--5月-->
            <td>{{$record['m6']}}</td><!--6月-->
            <td>{{$record['m7']}}</td><!--7月-->
            <td>{{$record['m8']}}</td><!--8月-->
            <td>{{$record['m9']}}</td><!--9月-->
            <td>{{$record['m10']}}</td><!--10月-->
            <td>{{$record['m11']}}</td><!--11月-->
            <td>{{$record['m12']}}</td><!--12月-->
          </tr>         
          @endforeach
          </tbody>
        </table>
        <div>
    </div><!--container-->
  </div><!--row-->
@endsection

@section('footer_load_css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
@endsection 

@section('footer_load_javascript')
  <script src="{{ URL::asset('/js/app.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection 