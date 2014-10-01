<?php

class RemindersController extends BaseController {

	protected $whitelist = array('getRemind', 'postRemind', 'getReset', 'postReset');

	public function getRemind()
	{
		return View::make('settings.pass_remind', $this->data);
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		$email = Input::only('email');
		
		//$user = User::where('email', $email)->first();

		$response = Password::remind($email, function($message){
				$message->subject('Telfazi Password Reset'); 
			});

		switch ($response)
		{
			case Password::INVALID_USER:
				return Redirect::back()->with('error', 'Sorry, the email address you entered is not existing.');

			case Password::REMINDER_SENT:
				return Redirect::back()->with('success', 'We have just sent to '.$email['email'].' an email link to reset your password.');
		
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{

		if (is_null($token)) App::abort(404);

		$reminder = PasswordRemind::where('token', $token)->first();

		if( empty($reminder) ){
			return Redirect::to('password/reset')->with('error', 'Sorry, this link is already expired.');
		}

		$this->data['email'] = $reminder->email;
		return View::make('settings.pass_reset', $this->data)->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
				return Redirect::back()->with('error', Lang::get($response));
			case Password::INVALID_TOKEN:
				return Redirect::back()->with('error', Lang::get($response));
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:
				
				return Redirect::to('login')->with('success', 'Your password has been changed.');
		}	
	}

}