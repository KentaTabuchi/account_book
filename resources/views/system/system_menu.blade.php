@extends('layouts.common_base')

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
    <div class="row">
      <ul>
          <li><a href="/system/manage_category?category_name=large">大分類を設定する</a></li>
          <li><a href="/system/manage_category?category_name=middle">中分類を設定する</a><li>
          <li><a href="/system/manage_category?category_name=small">小分類を設定する</a><li>
      </ul>
  </div>
@endsection

@section('footer_load_javascript')
@endsection

