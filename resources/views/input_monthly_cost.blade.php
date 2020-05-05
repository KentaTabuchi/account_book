@extends('layouts.common_base')

@section('navbar-current')
  <span class="navbar-text text-warning">月額固定費入力<span>
@endsection

@section('navbar-menu')
  <a class="nav-item nav-link" href="./read_book">家計簿を見る</a>
  <a class="nav-item nav-link" href="./read_book_aggregate?table_name=category_balance">年表を見る</a>
@endsection

@section('contents')
  <div class="row mtpx-100">
    <div class="container col-md-10 ml-5">
    <form action="input_monthly_cost" method="post" id="form" >
      @csrf
      <h1>{{$year}}年&nbsp;固定費表</h1>
      <div class="row">
      <input type="submit" value="更新する" class="btn btn-primary col-1"/>
      <div id="app" class="col-2"><select-years></select-years></div>
      </div>
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
          @foreach ($valuesList as $values)
          <tr>
          <td>{{$values['name']}}</td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m1" value={{$values['m_1']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m2" value={{$values['m_2']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m3" value={{$values['m_3']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m4" value={{$values['m_4']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m5" value={{$values['m_5']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m6" value={{$values['m_6']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m7" value={{$values['m_7']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m8" value={{$values['m_8']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m9" value={{$values['m_9']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m10" value={{$values['m_10']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m11" value={{$values['m_11']}}></td>
            <td><input type="text" class="form-control" name="code{{$values['small_code']}}m12" value={{$values['m_12']}}></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <input type="hidden" value="{{$year}}" name="year"/>
      </form>
    </div>
  </div>
@endsection

@section('footer_load_css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
@endsection 

@section('footer_load_javascript')
  <script src="{{ URL::asset('/js/app.js')}}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection 