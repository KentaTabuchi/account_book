@extends('layouts.common_base')

@section('navbar-current')
  <span class="navbar-text text-warning">履歴一覧<span>
@endsection

@section('navbar-menu')
  <a class="nav-item nav-link" href="./input_book">家計簿をつける</a>
  <a class="nav-item nav-link" href="./read_book_aggregate?table_name=category_balance">年表を見る</a>
@endsection

@section('contents')
  <div class="row mtpx-100">
    <div class="container col-md-8 justify-content-around">
    <h1>レシート一覧</h1>
        {{-- CSVボタン --}}
        <div>
          <button onclick="location.href='csv_download'" class="btn btn-outline-dark bg-light">CSVダウンロード</button>
        </div>
        {{-- 1ページの表示数 --}}
        <div>
          <p style="display:inline-block;font-weight:bold">表示数</p>
          <a href="receipt_list?page_size=10">10</a>
          <a href="receipt_list?page_size=20">20</a>
          <a href="receipt_list?page_size=50">50</a>
        </div>
        
        <table class="table table-dark col-xs-10 col-md-10 offset-1" data-toggle="table" data-pagination="true">
          <thead class="thead-light">
          <tr>
            <th class="d-none d-md-table-cell" data-sortable="true">日付</th>
            <th class="d-none d-md-table-cell" data-sortable="true">収支</th>
            <th class="d-none d-md-table-cell" data-sortable="true" class="d-none d-md-table-cell">大分類</th>
            <th class="d-none d-md-table-cell" data-sortable="true">中分類</th>
            <th data-sortable="true">小分類</th>
            <th data-sortable="true">金額</th>
            <th>詳細</th>
          </tr>
          </thead>
          <tbody>
          @foreach ($receipts as $receipt)
          <tr>
            <td class="d-none d-md-table-cell">{{$receipt->pay_day}}</td>
            <td>{{$receipt->balance_name}}</td>
            <td class="d-none d-md-table-cell">{{$receipt->large_name}}</td>
            <td>{{$receipt->middle_name}}</td>
            <td>{{$receipt->small_name}}</td>
            <td>{{$receipt->payment}}</td>
            <td><button type="button" onclick="location.href='comfirm_receipt?id={{$receipt->id}}'">詳細</button></td>
          </tr>         
          @endforeach
          </tbody>
        </table>
        {{$receipts->appends(['page_size'=>$page_size])->links()}}
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