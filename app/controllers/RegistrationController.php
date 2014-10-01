<?php

class RegistrationController extends BaseController {
	 protected $whitelist = array(
	 	
        'register_user',
        'store_user'
    );


	public function delete_user(){
        if(isset($_POST['delete_user'])){

            //Decrypt user ID.
            $user_id = Crypt::decrypt($_POST['user_id']);

            // Delete from database, by user ID.
            DB::table('users')->where('id', $user_id)->delete();

            return Redirect::to('users')->with('success', 'Successfully Deleted');
        }
    }

    public function register_user( $type = "" ){

        if($type == "publisher"){
            return View::make('frontend/regpublisher', $this->data);
        }
        


        return View::make('frontend/register', $this->data);
    }
    

    public function update_user(){

        if(isset($_POST['edit_user'])){
            $user_id = Crypt::decrypt( $_POST['user_id'] );

            // Set the rules for validation
            $rules = array(
                'firstname' => 'Required',
                'lastname' => 'Required',
                'username' => 'Required',
                'email' => 'Required|Email|Unique:users'
                );

            $inputs = Input::all();

            $validator = Validator::make( $inputs, $rules );

            $validate = $validator->passes();

            // Validate
            if($validate){

                // Get the updated data
                $data = array(
                    'first_name' => Input::get('firstname'),
                    'last_name' => Input::get('lastname'),
                    'username' => Input::get('username'),
                    'email' => Input::get('email'),
                    'updated_at' => date('Y-m-d H:i:s')
                );


                //Save the updated data
                DB::table('users')
                    ->where('id', $user_id)
                    ->update($data);


                
                // Redirect after a successful validation
                return Redirect::to('user/' . $user_id)->with('success', 'Information Successfully Updated!');
            }

            // Redirect if validation failed
            return Redirect::to('user/' . $user_id)->withInputs($inputs)->withErrors($validator->getMessageBag());
        }
    }

    public function store_user(){

        if(isset($_POST['add_user'])){

            // Declare the rules for the form validation
            $rules = array(
                'firstname' =>              'Required',
                'lastname' =>               'Required', 
                'username' =>               'Required|alpha_dash|Unique:users',
                'password' =>               'Required|Confirmed|between:6,12',
                'password_confirmation' =>  'Required',
                'email' =>                  'Required|Email|Unique:users'
            );

            // Get all the inputs
            $inputs = Input::all();

            // Validate the inputs
            $validator = Validator::make($inputs, $rules);

            $validated = $validator->passes();

            if($validated){     
                // Create new user
                $user = new User();
                $user->first_name = Input::get('firstname');
                $user->last_name = Input::get('lastname');
                $user->username = Input::get('username');
                $user->email = Input::get('email');
                $user->password = Hash::make(Input::get('password'));

                // Save a new user
                $user->save();

                // Create a User Channel
                $userChannel = new UserChannel();
                $userChannel->channel_name = $user->username;
                $userChannel->channel_id = uniqid();
                $userChannel->user_id = $user->id;
                $userChannel->save();

                $userType = Input::get('usertype');

                $role = Role::where('slug', $userType)->first();

                // Create new Assigned Role
                $assignedRole = new AssignedRole();
                $assignedRole->user_id = $user->id;
                $assignedRole->role_id = $role->id;
                $assignedRole->save();


                // Create User Information
                $userInfo = new UserInformation();
                $userInfo->user_id = $user->id;
                $userInfo->save();

                //Send email upon registration
                $this->data['user'] = $user;
                Mail::send('emails.registered',  $this->data,  function($message)  use ($user)
                {
                    $message->to($user->email, 'Telfazi')->subject('Welcome to Telfazi');
                });


                //Auto Loggin.
                if(Auth::attempt(array('username' => $user->username, 'password' => Input::get('password') ))){
                     
                    // Redirect to profile.
                    return Redirect::to('/');
                }
            }

            return Redirect::to('register')->withInput($inputs)->withErrors($validator->getMessageBag());
        }
    }
}