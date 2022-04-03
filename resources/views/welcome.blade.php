<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Всё в твоих силах! Действуй!">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#0134d4">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <!-- Title -->
    <title>Щит ДНР - Твоя республика в твоих руках!</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="img/core-img/favicon.ico">
    <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/icon-180x180.png">
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('/css/tiny-slider.css')}}">
    <link rel="stylesheet" href="{{asset('/css/baguetteBox.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/rangeslider.css')}}">
    <link rel="stylesheet" href="{{asset('/css/vanilla-dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/apexcharts.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="{{asset('/style.css')}}">
    <!-- Web App Manifest -->
    <link rel="manifest" href="{{asset('/manifest.json')}}">

    @if(\Illuminate\Support\Facades\Auth::check())
        <meta name="current-user" content="{{\Illuminate\Support\Facades\Auth::user()}}">
    @endif
</head>
<body>
<!-- Preloader -->
<div id="preloader">
    <div class="spinner-grow text-primary" role="status"><span class="visually-hidden">Loading...</span></div>
</div>

<!-- Internet Connection Status -->
<!-- # This code for showing internet connection status -->
<div class="internet-connection-status" id="internetStatus"></div>

<div id="app">
    <application></application>
</div>

<script src="{{ mix('/js/app.js') }}"></script>
<!-- All JavaScript Files -->
<script src="{{asset('/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('/js/slideToggle.min.js')}}"></script>
<script src="{{asset('/js/internet-status.js')}}"></script>
<script src="{{asset('/js/tiny-slider.js')}}"></script>
<script src="{{asset('/js/baguetteBox.min.js')}}"></script>
<script src="{{asset('/js/countdown.js')}}"></script>
<script src="{{asset('/js/rangeslider.min.js')}}"></script>
<script src="{{asset('/js/vanilla-dataTables.min.js')}}"></script>
<script src="{{asset('/js/index.js')}}"></script>
<script src="{{asset('/js/magic-grid.min.js')}}"></script>
<script src="{{asset('/js/dark-rtl.js')}}"></script>
<script src="{{asset('/js/active.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js" integrity="sha512-yFjZbTYRCJodnuyGlsKamNE/LlEaEAxSUDe5+u61mV8zzqJVFOH7TnULE2/PP/l5vKWpUNnF4VGVkXh3MjgLsg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- PWA -->
<script src="{{asset('/js/pwa.js')}}"></script>


</body>
</html>

