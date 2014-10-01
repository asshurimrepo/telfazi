<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoThumbnailSmallTable extends Migration {


	public function up()
	{
		Schema::create('video_thumbnail_small', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('video_id');
			$table->string('key');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('video_thumbnail_small');
	}

}
