<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityFeedsTable extends Migration {

	public function up()
	{
		Schema::create('activity_feeds', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->text('content');
			$table->integer('user_in');
			$table->integer('type_id');
			$table->text('activity_id');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('activity_feeds');
	}

}
