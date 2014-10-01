<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function mapData()
	{
		$this->display_name = $this->username;

		return $this;
	}
	public function information(){
		return $this->hasOne('UserInformation');
	}

	public function userChannels()
	{
		return $this->hasMany('UserChannel');
	}

	public function watched()
	{
		return $this->hasMany('WatchedVideo');
	}

	public function watchedVideos()
	{
		$recommended = Video::where(function($q){

            // Get Video Tags Per User Watched Videos
            $videos = Auth::user()->watched()->with('video')->get();
            $tags = array();

            foreach ($videos as $key => $v) {
                // merge Tags
            	if($v->video){
            		if(is_array($v->video->tags)){
            			$tags = array_merge( $tags, json_decode($v->video->tags));
            		}
            		
            	}
            	
            }

            // Remove Duplicates
            $tags = array_unique($tags);

            // Query Tags
            foreach ($tags as $key => $tag) {
                $q->orWhere('tags', 'like', '%'.$tag.'%');
            }

        });

        return $recommended;
	}

	public function recommendedVideos($take = 6)
	{
		return $this->watchedVideos()->byPublished()->take($take)->orderBy(DB::raw('RAND()'))->get();
	}

	public function getThumbnail(){
		
		if($this->information){
			
			if(empty($this->information->profile_picture) == false){
				if($this->information->picture_key){

					//check if file exists.
					if(file_exists('uploads/profilepic/'.$this->id.'/'.$this->information->picture_key)){
						return asset('uploads/profilepic/'.$this->id.'/'.$this->information->picture_key);	
					}
				}	
			}else{
				if(Session::get('login_type') == 'facebook'){
					$fb_data = Session::get('facebook_data');

					return 'https://graph.facebook.com/'.$fb_data->id.'/picture?type=large'; 
				}
			}
	    }

	    return asset('assets/img/img_default.jpg');
	}
	
	public function roles(){
		return $this->belongsToMany('Role', 'assigned_roles');
	}

	public function isAdmin(){
		if($this->roles())
			$role = $this->roles()->where('slug', 'admin')->first();
		
		//check for admin role
		if($role)
			return true;

		return false;
	}

	public function getDisplayName(){

		if($this->username == 'admin'){
			return '';
		}else{
			return $this->username;
		}
	}

	/*private function hasRole( $slug ){
		AssignedRole::where('user_id', $this->id)->whereHas('AssignedRole', function($q) use ($slug){
			$q->where('id', $slug )
		})
	}*/
}
