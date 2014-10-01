<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoTranslatesTable extends Migration {

	public function up()
	{
		Schema::create('video_translations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('video_id');
			$table->integer('language_id');
			$table->string('title');
			$table->string('description');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('video_translations');
	}

}
