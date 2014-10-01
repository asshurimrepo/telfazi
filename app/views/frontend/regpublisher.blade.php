@extends('layouts.alphaform')

@section('content')

<div class="row">

<div class="col-sm-6 col-md-4 col-md-offset-4">
    <h1 class="text-center login-title"><b>Create New Publisher Account</b></h1>
    <div class="account-wall">
       
        <form action="{{ URL::to('/user/store') }}" method="POST" class="form-signin">
            <input type="hidden" name="publisher" value="true">

            {{ Session::get('success'); }} <br>
            <input type="text" class="form-control" placeholder="First Name" required autofocus name="firstname">
            <span class="warning-block">
               {{ $errors->first('firstname') }}
            </span><br>
            <input type="text" class="form-control" placeholder="Last Name" required autofocus name="lastname">
            <span class="warning-block">
               {{ $errors->first('lastname') }}
            </span><br>
            <input type="email" class="form-control" placeholder="Email" required autofocus name="email">
            <span class="warning-block">
               {{ $errors->first('email') }}
            </span>

            {{ Form::select('usertype', array('regular' => 'Regular', 'publisher' => 'Publisher'), 'publisher', array('class' =>'form-control hide')); }}
            
            <span class="warning-block">
               {{ $errors->first('usertype') }}
            </span><br>
            <input type="text" class="form-control" placeholder="Username" required autofocus name="username">
            <span class="warning-block">
               {{ $errors->first('username') }}
            </span><br>
            <input type="password" class="form-control" placeholder="Password" required name="password" style="margin-bottom:15px">
            <span class="warning-block">
               {{ $errors->first('password') }}
            </span>
            <input type="password" class="form-control" placeholder="Confirm Password" required name="password_confirmation">
            <span class="warning-block">
               {{ $errors->first('password_confirmation') }}
            </span><br>
            
            <button class="btn btn-lg btn-warning btn-block" name="add_user" type="submit">
                Sign up</button>
            <a href="{{ URL::to('password/reset') }}" class="pull-right need-help">Forgot Password? </a><span class="clearfix"></span>
        </form>
    </div>
    <div class="separator-space-sm"></div>
    <div class="text-center">Already have an account? <a href="{{ URL::to('login') }}" class="new-account" style="display:inline"> Sign in </a></div>
</div>
</div>

@stop
