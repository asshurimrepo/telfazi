<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoThumbnailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('video_thumbnails', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('video_id');
			$table->text('thumbnail');
			$table->text('thumbnails');
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
		Schema::drop('video_thumbnails');
	}

}
