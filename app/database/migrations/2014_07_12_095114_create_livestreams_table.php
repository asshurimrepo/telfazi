<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLivestreamsTable extends Migration {

	public function up()
	{
		Schema::create('livestreams', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('video_id');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('livestreams');
	}
}
