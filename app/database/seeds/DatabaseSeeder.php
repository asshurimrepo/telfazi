<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		// $this->call('UserTableSeeder');
	}

}

class UserAccountsTableSeeder extends Seeder{
	public function run(){
		$data = array(
			'id' => 1,
			'type' => 'Administrator',
			);
		DB::table('user_accounts')->create($data);
	}
}