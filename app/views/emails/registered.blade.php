<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		
		@include('emails/logo')

		<p>Welcome to <b>Telfazi</b> <br>
		Your home of latest videos</p>
		

		<p>
			Thank you for registering at <a href="{{ url('/') }}">Telfazi.com</a> a place where you'll enjoy watching the latest movies from all lovers or Sports, Entertainment, Automotive and Alike.
		</p>

		<p>
			Having the most advance technology and the most powerful video player on the market, Telfazi gives both user and content creator the ability to work with HD video fast and easy. To access your account click 
			<a href="{{ url('login') }}">here</a>.
		</p>

		<p>
			Please don't hesitate to drop an mail to let me know how you enjoyed the experience or whether we could do things better.
		</p>

		<p>
			Thank you for choosing us and looking forward to helping you.
		</p>

		<p>
			Warm wishes, <br>
			<b>Telfazi Team</b>
		</p>
	</body>
</html>