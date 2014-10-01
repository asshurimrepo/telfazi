<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelSubscribersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('channel_subscribers', function(Blueprint $table) {
			$table->increments('id');
			$table->text('user_id');
			$table->text('channel_id');
			$table->boolean('subcribed');
			$table->boolean('unsubscribed');
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
		Schema::drop('channel_subscribers');
	}

}
