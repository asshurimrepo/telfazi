@extends('layouts.alphaform')



@section('content')


<div class="row">
    <div class="col-sm-6 col-md-4 col-md-offset-4">
        <h1 class="text-center login-title">Password Reset</h1>
        <div class="account-wall">
            
            <form action="{{ URL::to('password/request') }}" method="post" class="form-signin">
           
            <label> Please enter your email: </label>
            
            <input type="text" class="form-control" placeholder="Email" name="email" required autofocus>
            
            <span class="warning-block">
               {{ $errors->first('username') }}
            </span><br>
           
            <button class="btn btn-lg btn-warning btn-block" name="submit" type="submit">
                Submit
            </button>
            

            <span class="clearfix"></span>
            <div class="separator-space"></div>
            </form>
        

        </div>

    </div>
</div>


@stop
