<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoplaylistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('video_playlists', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('video_id');
			$table->integer('playlist_id');
			$table->string('channel_id');
			$table->timestamps();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('video_playlists');
	}

}
