<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('playlists', function(Blueprint $table) {
			$table->increments('id');
			$table->string('playlist_name');
			$table->string('playlist_description');
			$table->timestamps();
		});

		
		/*$data = array(
			array('playlist_name' => 'My Playlist', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
			array('playlist_name' => 'Watch Later', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
			array('playlist_name' => 'Favorites', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')),
			);

		DB::table('video_playlists')->insert($data);*/
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('playlists');

		//DB::table('playlists')->delete();
	}

}
