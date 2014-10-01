<?php

class ReportsSeeder extends Seeder{
	public function run(){
	
		DB::table('report_statuses')->delete();
		$data = array(
			array(
				'report_name' => 'Sexual content',
				'report_description' => 'Includes graphic sexual activity, nudity, and other sexual content.',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),
			array(
				'report_name' => 'Violent or repulsive content',
				'report_description' => 'Violent or graphic content, or content posted to shock viewers.',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),
			array(
				'report_name' => 'Hateful or abusive content',
				'report_description' => 'Content that promotes hatred against protected groups, abuses vulnerable individuals, or engages in cyberbullying.',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),
			array(
				'report_name' => 'Harmful dangerous acts',
				'report_description' => 'Content that includes acts that may result in physical harm.',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),
			array(
				'report_name' => 'Spam or misleading',
				'report_description' => 'Content that is massively posted or otherwise misleading in nature.',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),
			array(
				'report_name' => 'Infringes my rights',
				'report_description' => 'Privacy, copyright and other legal complaints.',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),
			array(
				'report_name' => 'Captions report (CVAA)',
				'report_description' => '',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),
			);

		DB::table('report_statuses')->insert($data);

	}
}
