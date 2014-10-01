

@if( Session::has('message') )
	{{ Session::get('message') }}
@endif
<form action="" method="POST">
	<label for="old_password">Old Password</label> <br>
	<input type="password" name="old_password"> <br>
	{{ $errors->first('old_password') }}<br>

	<label for="new_password">New Password</label> <br>
	<input type="password" name="new_password"> <br>
	{{ $errors->first('new_password') }}<br>

	<label for="new_password_confirmation">Confirm New Password</label> <br>
	<input type="password" name="new_password_confirmation"> <br>
	{{ $errors->first('password_confirmation') }}<br>

	<input type="submit" name="submit" value="Change Password"><br>
</form>

<a href="{{ URL::to('dashboard') }}">Back to Dashboard</a>