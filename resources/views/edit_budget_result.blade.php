@extends('layouts.common_base')

@section('navbar-current')
  <span class="navbar-text text-warning">変動費予算設定&nbsp;確認<span>
@endsection

@section('navbar-menu')
  <a class="nav-item nav-link" href="./read_book">家計簿を見る</a>
  <a class="nav-item nav-link" href="./read_book_aggregate?table_name=category_balance">年表を見る</a>
@endsection

@section('contents')
  <div class="row　justify-content-around mtpx-100">
    <div class="container col-10 offset-md-1 col-lg-4 card pnl-input-month bg-light" id="input_form">
      <form action="edit_budget" method="post" id="form" >
      @csrf
      <div class="card bg-dark card-mg-none">
        <p class="text-white h4 offset-3">{{$year}}年の変動費予算</p>
      </div>
        <div class="form-group row mt-4" >
          <label class="txt-itemname" >1月</label>
          <div class="col-8">
            <p class="txt-currency lead">{{$budgets[1]}}</p>
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >2月</label>
          <div class="col-8">
          <p class="txt-currency lead">{{$budgets[2]}}</p>            
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >3月</label>
          <div class="col-8">
          <p class="txt-currency lead">{{$budgets[3]}}</p>           
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >4月</label>
          <div class="col-8">
            <p class="txt-currency lead">{{$budgets[4]}}</p>
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >5月</label>
          <div class="col-8">
            <p class="txt-currency lead">{{$budgets[5]}}</p>
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >6月</label>
          <div class="col-8">
            <p class="txt-currency lead">{{$budgets[6]}}</p>
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >7月</label>
          <div class="col-8">
            <p class="txt-currency lead">{{$budgets[7]}}</p>
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >8月</label>
          <div class="col-8">
            <p class="txt-currency lead">{{$budgets[8]}}</p>
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname">9月</label>
          <div class="col-8">
            <p class="txt-currency lead">{{$budgets[9]}}</p>
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname">10月</label>
          <div class="col-8">
            <p class="txt-currency lead">{{$budgets[10]}}</p>
          </div>
        </div><!--form-group row-->
          <div class="form-group row" >
          <label class="txt-itemname" >11月</label>
          <div class="col-8">
            <p class="txt-currency lead">{{$budgets[11]}}</p>
          </div>
        </div><!--form-group row-->
        <div class="form-group row" >
          <label class="txt-itemname" >12月</label>
          <div class="col-8">
            <p class="txt-currency lead">{{$budgets[12]}}</p>
          </div>
        </div><!--form-group row-->
        <div class="row mt-5">
          <div class="container col-6 col-md-offset-1 mb-5">
          <button type="button" onclick="location.href='edit_budget?'" class="btn btn-primary">編集する</button>
          <button type="button" onclick="location.href='index.php'" class="btn btn-primary">ホームへ</button>    
          </div>
        </div><!--row-->
        <input type="hidden" name="year" value={{$year}}>
      </form>
    </div>
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