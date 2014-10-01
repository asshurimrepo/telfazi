<?php
class CategorySeeder extends Seeder{
	public function run(){

		categorySeeder();
	}
}


function categorySeeder(){
	$channel_id = uniqid();

	// Create category data
	DB::table('categories')->delete();
	$data = array(
		array('category_name' => 'Soccer'),
		array('category_name' => 'Automotive'));
	DB::table('categories')->insert($data);
}


