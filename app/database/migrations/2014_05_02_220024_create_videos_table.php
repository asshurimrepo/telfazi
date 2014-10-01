<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	/*public function up()
	{
		Schema::create('videos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('description', 2500);
			$table->string('name');
			$table->string('type');
			$table->string('size');
			$table->string('bucket');
			$table->string('key');
			$table->text('url');
			$table->text('thumbnail');
			$table->string('video_duration');
			$table->boolean('published');
			$table->text('tags');
			$table->timestamps();
		});
	}*/


	public function up()
	{
		Schema::create('videos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('description', 2500);
			$table->string('original_url');
			$table->string('video_url');
			$table->string('flv_url');
			$table->string('thumbnail_url');
			$table->date('creation_date');
			$table->string('duration');
			$table->int('views');
			$table->int('status');
			$table->int('last_modified_by');
			$table->date('modification_date');
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
		Schema::drop('videos');
	}

}
