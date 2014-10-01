<h2>Login</h2>
<form action="{{ URL::to('login/auth') }}" method="POST">
    <label for="">Username</label><br>
    <input type="text" name="username" value=""/><br>
    {{ $errors->first('username') }}<br>

    <label for="">Password</label><br>
    <input type="password" name="password" value=""/><br>
    {{ $errors->first('password') }}<br>

    <input type="submit" name="sign_in" value="Sign in"/>
    <a href="{{ URL::to('password/reset')}}"> Forgot Password </a>, 
    <a href="{{ URL::to('register') }}">Sign up</a>
</form>