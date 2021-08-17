@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{ asset('/css/menu_main/style.css') }}">
<div class="foreman-box2" id="foreman_box">
    <img class="foreman-item"   src="{{ asset('img/foreman_img2.svg') }}" alt="">
 </div>
 <div class="tower-box2">
     <img class="tower-item"   src="{{ asset('img/tower_img2.svg') }}" alt="">
  </div>
  <div class="money-box2">
     <img class="money-item"   src="{{ asset('img/money_img.svg') }}" alt="">
  </div>
  <div class="chart-col-box2">
     <img class="chart-col-item"   src="{{ asset('img/chart_col_img.svg') }}" alt="">
  </div>
<div class="container-fluid p-0 h-100">
    <div class="container-main-menu">
    
        <nav class="navbar navbar-expand-md header-main-1">
            <div class="">
                
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse h-51px" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown d-flex">
                                <div class="profile-name m-auto">
                                    {{-- nav-link dropdown-toggle --}}
                                    <span id="navbarDropdown"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </span>
                                    <span class="font-size-14px mt-n1">
                                        Position
                                    </span>
                                </div>
                                
                                <div class='profile-img-icon  m-auto  ml-16px'></div>
                                
                                <img class="bell-icon" src="{{ asset('img/bell_img2.svg')}}" aria-hidden="true"
                                />
                                
                                <img class="exit-icon" src="{{ asset('img/exit_img2.svg')}}"
                                id="navbarDropdown"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre
                                aria-hidden="true"
                                />
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <form id="form_main" action="" method="get">
                <div class="container-fluid mt-28px main-menu-body">
                    <div class="container-logo">
                        <div class="main-logo">
                            <img class="main-icon" src="{{ asset('img/icon_main0.png') }}" alt="">
                        </div>
                    </div>
                    <div class="container-menu">
                        <div class="container-menu-list">
                                <a class="menu-item" href="{{ url('/dashboard') }}">
                                    <img class="icon-main-manu" src="{{ asset('/img/menu_chart.svg') }}" alt="" srcset="">
                                    <span class="text-bold text-menu">ภาพรวมโครงการ</span>
                                </a>
                                <a class="menu-item" href="{{ url('/installment') }}">
                                    <img class="icon-main-manu" src="{{ asset('/img/menu_check.svg') }}" alt="" srcset="">
                                    <span class="text-bold text-menu">ส่งค่างวด</span>
                                </a>
                                <a class="menu-item" href="{{ url('/cut_over') }}">
                                    <img class="icon-main-manu" src="{{ asset('/img/menu_home.svg') }}" alt="" srcset="">
                                    <span class="text-bold text-menu">ตรวจส่งมอบบ้าน</span>
                                </a>
                                <a class="menu-item" href="{{ url('/cut_off') }}">
                                    <img class="icon-main-manu" src="{{ asset('/img/menu_cutoff.svg') }}" alt="" srcset="">
                                    <span class="text-bold text-menu">Cutoff</span>
                
                                </a>
                                <a class="menu-item" href="{{ url('/report') }}">
                                    <img class="icon-main-manu" src="{{ asset('/img/menu_report.svg') }}" alt="" srcset="">
                                    <span class="text-bold text-menu">สรุป %จ่าย</span>
                                </a>
                                <a class="menu-item" href="{{ url('/setting') }}">
                                    <img class="icon-main-manu" src="{{ asset('/img/menu_setting.svg') }}" alt="" srcset="">
                                    <span class="text-bold text-menu">ตั้งค่า</span>
                                </a>
                    </div>
                    
                </div>
                </form>
    </div>
    
</div>


<script>

    const submitMenu = (fromName,urlPath)=>{
        $(`form`).attr(`action`,urlPath)
        document.getElementById(fromName).submit();
    }
    $(document).ready(function () {
        setTimeout(() => {
                $(`.foreman-box2`).css(`animation-play-state`,`paused`)
        }, 3500);
    });
    
    $(`#show_pass`).click(function(){
        let passType = $(`#password`).attr(`type`)
        let newType = passType === `password` ? `text`: `password`
        $(`#password`).attr(`type`,newType)
    })
    
     </script>

@endsection