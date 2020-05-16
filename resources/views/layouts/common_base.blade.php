<!DOCTYPE html>
<html lang="ja">
  <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <!-- BootstrapのCSS読み込み -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery読み込み -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- BootstrapのJS読み込み -->
  <script src="js/bootstrap.min.js"></script>
  <link href="css/reset.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
  <!-- Vue.jsのJS読み込み -->    
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
  <!--ホームアイコンの設定-->
  <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
  <link rel="apple-touch-icon" href="/images/apple-touch-icon.png" sizes="180x180">
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="icon" type="image/png" href="/android-touch-icon.png" sizes="192x192">
  @yield('load_javascript')
  <title>家計簿</title>
  </head>
  
  <body style="background-image: url('/images/common/background.jpg')">
  <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/index.php"><img src="/images/common/home_icon.png" class="nav-homeicon bg-white"><a>
    @yield('navbar-current')
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navmenu"
     aria-controls="navmenu" area-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
     </button>
    <p class="text-white d-inline">ログイン中:{{$user->name}}さん</p> 
    <a href="{{ route('logout') }}" onclick="event.preventDefault();
      document.getElementById('logout-form').submit();">ログアウト</a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <div class="collapse navbar-collapse" id="navmenu">
      <div class="navbar-nav">
        @yield('navbar-menu')
      </div>
      <!--.navbar-nav-->
    </div>
    <!--#navmenu-->
  </nav>
  @yield('contents')

  @yield('footer_load_css')
  @yield('footer_load_javascript')
  </body>
</html>