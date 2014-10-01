<?php
class BundleSeeder extends Seeder{
	public function run(){
		usersSeeder();
		rolesSeeder();
		assignedRolesSseder();
		channelsSeeder();
	}
}


function usersSeeder(){
	DB::table('users')->delete();

	$groupData = 
		array(
			array(	
				'username' => 		'admin',
				'password' =>		Hash::make('admin'),
				'email' => 			'powerlogic1992@gmail.com',
				'firstname' => 		'Juni',
				'lastname' => 		'Brosas',
				'created_at' => 	date('Y-m-d H:i:s'),
				'updated_at' => 	date('Y-m-d H:i:s')
			),
			array(	
				'username' => 		'max',
				'password' =>		Hash::make('max'),
				'email' => 			'',
				'firstname' => 		'Max',
				'lastname' => 		'Nocete',
				'created_at' => 	date('Y-m-d H:i:s'),
				'updated_at' => 	date('Y-m-d H:i:s')
			),
		);

	DB::table('users')->insert($groupData);
}

function rolesSeeder(){
	DB::table('roles')->delete();

	$data = 
		array(
			array(
				'name' => 'Administrator',
				'slug' => 'admin',
				'created_at' => 	date('Y-m-d H:i:s'),
				'updated_at' => 	date('Y-m-d H:i:s')
				),
			array(
				'name' => 'Publisher',
				'slug' => 'publisher',
				'created_at' => 	date('Y-m-d H:i:s'),
				'updated_at' => 	date('Y-m-d H:i:s')
				),
			array(
				'name' => 'Regular',
				'slug' => 'regular',
				'created_at' => 	date('Y-m-d H:i:s'),
				'updated_at' => 	date('Y-m-d H:i:s')
				),
		);

	DB::table('roles')->insert($data);
}

function assignedRolesSseder(){
	DB::table('assigned_roles')->delete();

	$data = array(
		array(
			'user_id' => DB::table('users')->where('username','admin')->first()->id,
			'role_id' => DB::table('roles')->where('name','Administrator')->first()->id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
			),
		array(
			'user_id' => DB::table('users')->where('username','max')->first()->id,
			'role_id' => DB::table('roles')->where('name','Publisher')->first()->id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
			),
	);
	

	DB::table('assigned_roles')->insert($data);
}


function channelsSeeder(){
	$channel_id = uniqid();

	// Create a new user channel
	DB::table('user_channels')->delete();
	$data = array(
			'channel_id' => $channel_id,
			'user_id'=> DB::table('users')->where('username','admin')->first()->id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
			);
	DB::table('user_channels')->insert($data);

	// Create a new video
	DB::table('videos')->delete();

	$data = array(
		'title' => 'My First Video',
		'description'=> 'This is my first video',
		'url' => 'https://s3-ap-southeast-1.amazonaws.com/telfasi/soccer/video1.mp4',
		'tags' => '["soccer", "football", "sports"]',
		'name' => 'video.mp4',
		'created_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s')
		);
	$video_id = DB::table('videos')->insertGetId($data);

	
	// Create a new channel
	DB::table('channels')->delete();

	$data = array(
			'channel_id' => $channel_id,
			'video_id'=> $video_id,
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
			);
	DB::table('channels')->insert($data);

	//Create new Tag
	DB::table('tags')->delete();

	$data = array(
		array(
			'tag_name' => 'soccer',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
			),
		array(
			'tag_name' => 'basketball',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s')
			),
		);
	DB::table('tags')->insert($data);

	//Tag a New Video
	DB::table('video_tags')->delete();
	$data = array(
		'video_id' => $video_id,
		'tag_id' => DB::table('tags')->where('tag_name', 'soccer')->first()->id,
		'created_at' => date('Y-m-d H:i:s'),
		'updated_at' => date('Y-m-d H:i:s')
		);
	DB::table('video_tags')->insert($data);
}

function categorySeeder(){
	$channel_id = uniqid();

	// Create category data
	DB::table('categories')->delete();
	$data = array(
		array('category_name' => 'soccer'),
		array('category_name' => 'automotive'),
		array('category_name' => 'player')
		);
	DB::table('categories')->insert($data);
}
