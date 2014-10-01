<?php

class PlaylistsSeeder extends Seeder{
	public function run(){
	
		DB::table('playlists')->delete();
		$data = array(
			array('playlist_name' => 'My Playlist', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
			array('playlist_name' => 'Watch Later', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
			array('playlist_name' => 'Favorites', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
			);

		DB::table('playlists')->insert($data);

	}
}
