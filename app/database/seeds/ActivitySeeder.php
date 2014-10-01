<?php
class ActivitySeeder extends Seeder{
	public function run(){
		DB::table('activity_types')->delete();
		$data = array(
			array('type_name' => 'Video', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
			array('type_name' => 'Playlist', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
			array('type_name' => 'Like', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
			array('type_name' => 'Post', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
			array('type_name' => 'Subscription', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),	
			);

		DB::table('activity_types')->insert($data);
	}
}