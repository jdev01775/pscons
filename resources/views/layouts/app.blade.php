<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'PSCons') }}</title> --}}
    <title>PS Cons</title>
    {{-- <link rel="shortcut icon" href="{{ asset('img/icon_main0.png') }}" type="image/x-icon"> --}}
    <link rel="shortcut icon" href="{{ asset('img/logo.svg') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- Jqeury --}}
    <script src="{{ asset('vendor/jquery/jquery-3.6.0.min.js') }}"  ></script>

{{-- font awesome --}}
    <link rel="stylesheet" href="{{ asset('vendor/font_awesome/css/font-awesome.css') }}">

    
    <link rel="stylesheet" type="text/css" href="{{ asset('/vendor/preload_page/style.css') }}"/>
{{-- <script type="text/javascript" src="{{ asset('/vendor/loadingbar/loading-bar.min.js') }}"></script> --}}
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- component css --}}
<link rel="stylesheet" href="{{ asset('/css/component_alert/style.css') }}">


<script  >

var confirmButtonText = `<div class="d-flex justify-content-center">
                              <img src="{{asset('img/icon_check.svg')}}">
                              <span class="ml-1">ยืนยัน</span>
                            </div>
                          `
var denyButtonText = `<div class="d-flex justify-content-center">
                            <img src="{{asset('img/icon_close.svg')}}">
                            <span class="ml-1">ยกเลิก</span>
                        </div>
                        `
</script>
</head>
<body style="height: 100% !important">

    {{-- preloader --}}
    <div class="preloader-div">
            <div class="svg-file z-logo">
               <svg width="30" height="30" viewBox="0 0 61 98" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M13.4162 28.8511V36.5931L53.6649 59.8584V76.8369L30.184 90.2923L6.70811 76.8369V67.2427L0 63.3962V72.9904V80.4874V80.703L30.184 98L60.373 80.703V80.4874V72.9904V55.8306L53.6649 51.9791L13.4162 28.8511Z" fill="#003927"/>
    <path d="M30.1841 0L6.10352e-05 17.297V17.3754V25.0096V55.6886L6.70817 59.5302V21.1631L30.1841 7.70771L53.6649 21.1631V44.252L60.373 48.1034V25.0096V17.3754V17.297L30.1841 0Z" fill="#003927"/>
    </svg>
            </div>
    </div>

 

    @yield('content')
     
</body>
<script >

document.onreadystatechange = () => {
  if (document.readyState === 'complete') {
    //    setTimeout(() => {
        $(`.preloader-div`).fadeOut();
        // }, 2300);
  }
};
</script>
</html>
