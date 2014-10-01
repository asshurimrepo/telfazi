<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		
		@include('emails/logo')

		<!-- <p><b>Dear {{ $user->firstname . ' ' . $user->lastname }},</b></p>

		<p>You recently initiated a password reset for your Telfazi ID. To complete the process, click the link below.</p>

		<p><a href="{{ URL::to('password/reset/'.$token) }}">Reset Now</a></p>

		<p>This link will expire three hours after this email was sent.</p>

		<p>
			If you didn’t make this request, it's likely that another user has entered your email address by mistake and your account is still secure. If you believe an unauthorized person has accessed your account, you can reset your password.
		</p>
		<br>
		<p>Telfazi Support</p> -->

		<p>Hello There, </p>

		<p>A password reset was requested for you telfazi account. If this was you, you can set a new password by click below link: </p>

		<p><a href="{{ URL::to('password/reset/'.$token) }}"><b>Here</b></a></p>

		<p>If you don't want to change your password or didn't request this, just ignore and delete this message. To keep your account secure, please don't forward this email to anyone. </p>

		<p>Thank you! <br>
		Telfazi Team</p>

	</body>
</html>

