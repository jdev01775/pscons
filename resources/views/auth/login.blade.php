@extends('layouts.app')

@section('content')
<div class="foreman-box" id="foreman_box">
    <img class="foreman-item"   src="{{ asset('img/foreman_img1.svg') }}" alt="">
 </div>
 <div class="tower-box">
    <img class="tower-item"   src="{{ asset('img/tower_img2.svg') }}" alt="">
 </div>
 <div class="money-box">
    <img class="money-item"   src="{{ asset('img/money_img.svg') }}" alt="">
 </div>
 <div class="chart-col-box">
    <img class="chart-col-item"   src="{{ asset('img/chart_col_img.svg') }}" alt="">
 </div>
 
<div class="container-fluid container-login ">
  <div class="card card-login" style="">
        </div>
        <div class="card card-login2">
            <div class="adjust-layout-login" >
                <div class="container-logo login-logo ">
                    <div class="main-logo">
                        <img class="main-icon" src="{{ asset('img/icon_main0.png') }}" alt="">
                    </div>
                </div>
                <div class="d-flex justify-content-center  login-logo-welcome">
                    <img class="main-icon" src="{{ asset('img/logo_welcom_top.png') }}" alt="">
                </div>
                <div class="card-body login-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="">
                                <input id="username" type="text" class="form-control ip-login @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" 
                                required autocomplete="username" autofocus placeholder="Username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="input-group mb-3" >
                                <input id="password" type="password" 
                                class="form-control ip-login @error('password') is-invalid @enderror" 
                                name="password" required autocomplete="current-password" 
                                placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div class="input-group-append eye-icon">
                                    
                                <img role="button" id="show_pass"  src="{{ asset('img/eye_icon.svg') }}" alt="">
                            </div>

                        </div>
                        
                        
                        <div class="d-flex justify-content-end  "   style="z-index: 2">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link  btn-forget-password" href="{{ route('password.request') }}">
                                <span>ลืมรหัสผ่าน ?</span>
                            </a>
                        @endif
                        </div>
                        <div class="div-submit-login ">
                                <button type="submit" class="btn   btn-login">
                                    <span>เข้าสู่ระบบ</span>
                                </button>

                                
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
</div>
      
       


 <script>
$(document).ready(function () {
    setTimeout(() => {
            $(`.foreman-box`).css(`animation-play-state`,`paused`)
    }, 3500);
});

$(`#show_pass`).click(function(){
    let passType = $(`#password`).attr(`type`)
    let newType = passType === `password` ? `text`: `password`
    $(`#password`).attr(`type`,newType)
})

 </script>
 
 @endsection
