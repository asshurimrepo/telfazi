<?php

class SettingController extends BaseController{
	public function showUserSettings(){
		return Redirect::to('mytv/profile');
	}
	public function categories(){

		return View::make('settings.categories');
	}
	public function edit_account(){
		if(Auth::check()){
			$user = Auth::user();

			$this->data['user'] = $user;

			return View::make('user/editUser', $this->data);
		}
	}
	public function getChangePassword(){
		if(Auth::check()){
			$video = new Video();
			$video->title = '';
			$video->description = 'My First Video Description';
			$video->path = 'My first video path';
			$success = $video->save();
			if($success){
				echo 'success';
			}else{
				$errors = $video->errors()->all();

				Util::trace($errors);
			}

			return View::make('settings/pass_change');
		}
	}
	public function postChangePassword(){
		if(Auth::check()){
			$user = Auth::user();

			// Get selected input fields
			$inputs = Input::only(array('old_password', 'new_password', 'new_password_confirmation'));

			$rules = array(
					'old_password' => 'Required',
					'new_password' => 'Required|Confirmed|Between:6,12',
					'new_password_confirmation' => 'Required'
				);

			$validator = Validator::make($inputs, $rules);

			if($validator->passes()){

				// Get the user given password.
				$old_pass = $inputs['old_password'];

				// Check the password if matched.
				if(Hash::check($old_pass, Auth::user()->password)){
					
					// Hash the new password
					$new_pass = Hash::make($inputs['new_password']);

					// Find a user data by current user ID.
					$user = User::find( Auth::user()->id );
					
					if(isset($user)){
						
						$user->password = $new_pass;
						
						$user->save();
						
						$message = 'Password has been successfully changed.';
					}
					else{
						$message = 'User data is not found';
					}


				}else{
					$message = 'Password did not match.';
				}

				return Redirect::to('settings/password')->with('message', $message);
			
			}else{

				return Redirect::to('settings/password')->withInputs($inputs)->withErrors($validator->getMessageBag());
			}

			
			
			
		}
	}
}