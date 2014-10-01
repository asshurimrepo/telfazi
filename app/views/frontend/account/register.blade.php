{{--
<h2>Register</h2>

<form action="{{ URL::to('/user/store') }}" method="POST">
    {{ Session::get('success'); }} <br>

    <label for="">First Name:</label><br>
    <input type="text" name="firstname" /><br>
    {{ $errors->first('firstname') }} <br>

    <label for="">Last Name:</label><br>
    <input type="text" name="lastname" /><br>
    {{ $errors->first('lastname') }} <br>

    <label for="usertype">User Type: </label><br>
    {{ Form::select('usertype', array('regular' => 'Regular', 'publisher' => 'Publisher'), 'S'); }}<br>
    {{ $errors->first('usertype'); }}<br>

    <label for="">Username:</label><br>
    <input type="text" name="username" /><br>
    {{ $errors->first('username') }} <br>

    <label for="">Email:</label><br>
    <input type="text" name="email" /><br>
    {{ $errors->first('email') }} <br>

    <label for="">Password:</label><br>
    <input type="password" name="password" /><br>
    {{ $errors->first('password') }}<br>


    <label for="">Confirm Password:</label><br>
    <input type="password" name="password_confirmation" /><br>
    {{ $errors->first('password_confirmation') }}<br>

    <a href="{{ URL::to('login') }}">Sign In</a>
    <input type="submit" name="add_user" value="Submit" /><br>
</form>

    ---}}

@extends('layouts.form')

@section('content')

<div class="row">

<div class="col-sm-6 col-md-4 col-md-offset-4">
    <h1 class="text-center login-title">Sign in to continue to Telfasi</h1>
    <div class="account-wall">
       
        <form class="form-signin">
        <input type="text" class="form-control" placeholder="First Name" required autofocus>
        <input type="text" class="form-control" placeholder="Last Name" required autofocus>
        <input type="email" class="form-control" placeholder="Email" required autofocus>
        <select class="form-control" placeholder="asd">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5</option>
        </select>
        <input type="text" class="form-control" placeholder="Username" required autofocus>
        <input type="password" class="form-control" placeholder="Password" required>
        <input type="password" class="form-control" placeholder="Confirm Password" required>


        <button class="btn btn-lg btn-warning btn-block" type="submit">
            Sign up</button>
        <!-- <label class="checkbox pull-left">
            <input type="checkbox" value="remember-me">
            Remember me
        </label>
        <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span> -->
        </form>
    </div>
    <div class="separator-space-sm"></div>
    <div class="text-center">Already have an account? <a href="{{ URL::to('register') }}" class="new-account" style="display:inline"> Sign in </a></div>
</div>
</div>



@stop

<style type="text/css">

.form-signin
{
    max-width: 330px;
    padding: 15px;
    margin: 0 auto;
}
.form-signin .form-signin-heading, .form-signin .checkbox
{
    margin-bottom: 10px;
}
.form-signin .checkbox
{
    font-weight: normal;
}
.form-signin .form-control
{
    position: relative;
    font-size: 16px;
    height: auto;
    padding: 10px;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.form-signin .form-control:focus
{
    z-index: 2;
}
.form-signin input[type="text"]
{
    margin-bottom: -1px;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}
.form-signin input[type="password"]
{
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}
.account-wall
{
    margin-top: 20px;
    padding: 40px 0px 20px 0px;
    background-color: #f7f7f7;
    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
}
.login-title
{
    color: #555;
    font-size: 18px;
    font-weight: 400;
    display: block;
}
.profile-img
{
    width: 96px;
    height: 96px;
    margin: 0 auto 10px;
    display: block;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
}
.need-help
{
    margin-top: 10px;
}
.new-account
{
    display: block;
    margin-top: 10px;
}
</style>