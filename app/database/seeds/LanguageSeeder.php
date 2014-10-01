<?php

class LanguageSeeder extends Seeder{
	public function run(){
	
		DB::table('languages')->delete();
		$data = array(
			array(
				'slug' => 'en',
				'language' => 'English',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),
			array(
				'slug' => 'ar',
				'language' => 'Arabic',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),
			);

		DB::table('languages')->insert($data);
	}
}
