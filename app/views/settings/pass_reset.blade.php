@extends('layouts.alphaform')


@section('content')
	<div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4">
        <h1 class="text-center login-title">New Password</h1>
        <div class="account-wall">
            
            <form action="{{ URL::to('password/update') }}" method="post" class="form-signin">
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

         	<input type="password" class="form-control" placeholder="New Password" name="password" required autofocus>
         	 <span class="warning-block">
               {{ $errors->first('password') }}
            </span><br>

         	<input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autofocus>
         	<span class="warning-block">
               {{ $errors->first('confirm_password') }}
            </span>
           	<div class="separator-space-sm"></div>
            <button class="btn btn-lg btn-warning btn-block" name="submit" type="submit">
                Submit
            </button>            

            <span class="clearfix"></span>
            </form>
        </div>
    </div>
</div>

@stop






