@extends('layouts.alphaform')

@section('content')

<div class="row">

<div class="col-sm-6 col-md-4 col-md-offset-4">
    <h1 class="text-center login-title"><b>{{ Lang::get('lang.create_new_account') }}</b></h1>
    <div class="account-wall">
       
        <form action="{{ URL::to('/user/store') }}" method="POST" class="form-signin">
        {{ Session::get('success'); }} <br>
        <input type="text" class="form-control" placeholder="{{ Lang::get('lang.first_name') }}" required autofocus name="firstname">
        <span class="warning-block">
           {{ $errors->first('firstname') }}
        </span><br>
        <input type="text" class="form-control" placeholder="{{ Lang::get('lang.last_name') }}" required autofocus name="lastname">
        <span class="warning-block">
           {{ $errors->first('lastname') }}
        </span><br>
        <input type="email" class="form-control" placeholder="{{ Lang::get('lang.email') }}" required autofocus name="email">
        <span class="warning-block">
           {{ $errors->first('email') }}
        </span>

        {{ Form::select('usertype', array('regular' => 'Regular', 'publisher' => 'Publisher'), null, array('class' =>'form-control hide')); }}
        
        <span class="warning-block">
           {{ $errors->first('usertype') }}
        </span><br>
        <input type="text" class="form-control" placeholder="{{ Lang::get('lang.username') }}" required autofocus name="username">
        <span class="warning-block">
           {{ $errors->first('username') }}
        </span><br>
        <input type="password" class="form-control" placeholder="{{ Lang::get('lang.password') }}" required name="password" style="margin-bottom:15px">
        <span class="warning-block">
           {{ $errors->first('password') }}
        </span>
        <input type="password" class="form-control" placeholder="{{ Lang::get('lang.confirm_password') }}" required name="password_confirmation">
        <span class="warning-block">
           {{ $errors->first('password_confirmation') }}
        </span><br>
        
        <button class="btn btn-lg btn-warning btn-block" name="add_user" type="submit">
            {{ Lang::get('lang.sign_up') }}</button>
        <a href="{{ URL::to('password/reset') }}" class="pull-right need-help">{{ Lang::get('lang.forget_password') }}? </a><span class="clearfix"></span>
        </form>
    </div>
    <div class="separator-space-sm"></div>
    <div class="text-center">{{ Lang::get('lang.already_have_an_account') }}? <a href="{{ URL::to('login') }}" class="new-account" style="display:inline"> {{ Lang::get('lang.sign_in') }} </a></div>
</div>
</div>

@stop
