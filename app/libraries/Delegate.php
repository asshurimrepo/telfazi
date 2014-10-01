<?php

class Delegate{

	/*
	$user = User::find(3);

	$role = Delegate::getRole($user);

	$hasRole = Delegate::hasRole($user, 'User'); //returns false

	*/
	

	// Get the role of the User object by User ID
	public static function getRole($user){
		$result = Delegate::getAssignedRole($user->id);
		
		if(count($result) > 0){
			foreach($result as $r){
				
				return $r->name;
			}
		}
	}

	// check if the User role is equivalent to the role given in the second parameter
	public static function hasRole($user, $assumed_role){
		$bool = false;
		$result = Delegate::getAssignedRole($user->id);
		

		if(count($result) > 0){
			foreach($result as $r){
				
				if($r->name == $assumed_role){
					$bool = true;
				}
			}
		}

		return $bool;
	}

	private static function getAssignedRole($user_id){		
		$result = DB::table('assigned_roles')
					->join('users', 'assigned_roles.user_id', '=', 'users.id')
					->join('roles', 'assigned_roles.role_id', '=', 'roles.id')
					->where('users.id', $user_id)
					->select('users.id', 'roles.name')
					->get();

		return $result;
	}
}