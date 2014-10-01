@extends('layouts.alphaform')

@section('content')
    <div class="col-sm-6 col-md-4 col-md-offset-4">
    <h1 class="text-center login-title"><b>{{ Lang::get('lang.sign_in_to_continue_to_telfazi') }}</b></h1>
    <div class="account-wall">
        <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
            alt="">
        <form action="{{ URL::to('login/auth') }}" method="post" class="form-signin">
        <input type="text" class="form-control" placeholder="{{ Lang::get('lang.username') }}" name="username" required autofocus>
        <span class="warning-block">
           {{ $errors->first('username') }}
        </span><br>
         {{--{{ $errors->first('username') }}<br>--}} 
        <input type="password" class="form-control" name="password" placeholder="{{ Lang::get('lang.password') }}" required>
        <span class="warning-block">
           {{ $errors->first('password') }}
        </span><br>
        <button class="btn btn-lg btn-warning btn-block" name="sign_in" type="submit">
            {{ Lang::get('lang.sign_in') }}</button>

        <div class="separator-space-sm"></div>
        

        <div class="text-center">
            <p> OR </p>
            <a href="#" onClick="checkLoginState();"><img src="{{ asset('assets/img/fb-login.png') }}" border="0" alt=""></a>
            <div id="login_status"></div>
        </div>


        <div class="separator-space-sm"></div>

        <label class="checkbox pull-left" >
            <input type="checkbox" value="remember-me">
            {{ Lang::get('lang.remember_me') }}
        </label>
        
        <a href="{{ URL::to('password/reset') }}" class="need-help pull-right">{{ Lang::get('lang.forget_password') }}? </a>
        
        <span class="clearfix"></span>
        </form>
    </div>
        <div class="separator-space">
            <a href="{{ URL::to('register') }}" class="text-center new-account">{{ Lang::get('lang.create_new_account') }} </a>
        </div>
    </div>


    
    @include('scripts.fblogin')

@stop




