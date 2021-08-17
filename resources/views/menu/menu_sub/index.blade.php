@extends('layouts.app')
@section('content')
 @php
use App\UserLinkImg;
use App\Position ;
$users_link_img = UserLinkImg::where('users_id',Auth::user()->id)->get();
$position = Position::where('position_id',Auth::user()->position_id)->get();
 
 
 @endphp
<link rel="stylesheet" href="{{asset('/css/menu_sub/style.css')}}">
<div id="app" class="container-main">
    <nav class="navbar navbar-expand-md header-main">
        <div class="container-fluid">
            <div class="logo-box">
                <a href="{{ url('/home', []) }}">
                   <img  src="{{ asset('img/main_logo.svg')}}" />
                </a>
            </div>
            <div class="">
                <img src="{{ asset('img/home2_icon.svg')}}" />
            </div>
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
                     
                        <li class="nav-item dropdown d-flex">
                            <div class="profile-name m-auto">
                                {{-- nav-link dropdown-toggle --}}
                                <span id="navbarDropdown"  href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </span>
                                <span class="font-size-14px mt-n1">
                                    {{ $position[0]['position_name']}}
                                </span>
                            </div>
                            
                            <div class='profile-img-icon  m-auto  ml-16px'>
                                <img src="{{ asset($users_link_img[0]['users_link_img_path']) }}" alt="">
                            </div>
                            
                            <img class="bell-icon" src="{{ asset('img/bell_icon.svg')}}" aria-hidden="true"
                            />
                            <img class="exit-icon" src="{{ asset('img/exit_icon.svg')}}"
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
                </ul>
            </div>
        </div>
    </nav>
    <div class="d-flex">
        <nav id="sidebarMenu" 
        class="d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky">
              <ul class="nav flex-column">
                <li class="nav-item burger-box">
                  <a class="nav-link icon-sidebar-box" href="#">
                      {{-- <img src="{{ asset('img/burger_icon.svg')}}" /> --}}
                      <object class="icon-side-menu" data="{{ asset('img/burger_icon.svg')}}" width="28" height="28" > </object>
                  </a>
                </li>
                <li class="nav-item">
                   <div  class="nav-link icon-sidebar-box @if (Request::getPathInfo() === '/dashboard') active  @endif" >
                    <a
                    href="{{ url('/dashboard') }}">
                        @if (Request::getPathInfo() === '/dashboard') 
                             <img src="{{ asset('img/page_dashboard_icon_white.svg')}}" />
                        @else  
                             <img src="{{ asset('img/page_dashboard_icon.svg')}}" />
                        @endif

                    </a>
                   </div>
                  
                  </li>
                  <li class="nav-item">
                    <div  class="nav-link icon-sidebar-box @if (Request::getPathInfo() === '/installment') active  @endif" >
                        <a 
                            href="{{ url('/installment') }}">
                                @if (Request::getPathInfo() === '/installment') 
                                    <img src="{{ asset('img/page_list_icon_white.svg')}}" />
                                @else  
                                    <img src="{{ asset('img/page_list_icon.svg')}}" />
                                @endif
                            
                            </a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <div  class="nav-link icon-sidebar-box @if (Request::getPathInfo() === '/cut_over') active  @endif" >
                        <a 
                            href="{{ url('/cut_over') }}">
                                @if (Request::getPathInfo() === '/cut_over') 
                                    <img src="{{ asset('img/home_icon_white.svg')}}" />
                                @else  
                                    <img src="{{ asset('img/home_icon.svg')}}" />
                                @endif
                            
                            </a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <div  class="nav-link icon-sidebar-box @if (Request::getPathInfo() === '/cut_off') active  @endif" >
                        <a 
                            href="{{ url('/cut_off') }}">
                                @if (Request::getPathInfo() === '/cut_off') 
                                <img src="{{ asset('img/cal_icon_white.svg')}}" />
                                @else  
                                <img src="{{ asset('img/cal_icon.svg')}}" />
                                @endif
                            </a>
                    </div>

                    
                  </li>
                  <li class="nav-item">
                    <div  class="nav-link icon-sidebar-box @if (Request::getPathInfo() === '/report') active  @endif" >
                        <a 
                            href="{{ url('/report') }}">
                                @if (Request::getPathInfo() === '/report') 
                                <img src="{{ asset('img/page_percent_icon_white.svg')}}" />
                                @else  
                                <img src="{{ asset('img/page_percent_icon.svg')}}" />
                                @endif
                            </a>
                    </div>
                  
                  </li>
                  <li class="nav-item">
                    <div  class="nav-link icon-sidebar-box @if (Request::is('setting','setting/*')) active  @endif" >
                        <a 
                            href="{{ url('/setting') }}">
                                @if (Request::is('setting','setting/*')) 
                                <img src="{{ asset('img/setting_icon_white.svg')}}" />
                                @else  
                                <img src="{{ asset('img/setting_icon.svg')}}" />
                                @endif
                            </a>
                    </div>

                   
                  </li>
                {{-- <hr /> --}}
              </ul>
            </div>
          </nav>
          <main role="main" class="container-body">
            @yield('content_sub')
          </main>
    </div>
  
</div>

@endsection
