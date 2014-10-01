<?php

/*$videos = array();
		foreach($videos as $v){
			Util::trace($v->title);
		}

		$videos = array(
			array(
				'title' => 'هونداي سوناتا - Hyundai Sonata 2013-96',
				'description' => 'This is a sample description',
				'name' =>'هونداي سوناتا - Hyundai Sonata 2013-96.mp4',
				'url' => 'https://s3-us-west-2.amazonaws.com/vidorabia/%D9%87%D9%88%D9%86%D8%AF%D8%A7%D9%8A+%D8%B3%D9%88%D9%86%D8%A7%D8%AA%D8%A7+-+Hyundai+Sonata+2013-96.mp4',
				'video_duration' => '',
				'tags' => json_encode(array('car','mobile')), 
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),
			array(
				'title' => 'هونداي إلنترا - Hyundai Elantra 2013-94',
				'description' => 'This is a sample description',
				'name' => 'هونداي إلنترا - Hyundai Elantra 2013-94.wmv',
				'url' => 'https://s3-us-west-2.amazonaws.com/vidorabia/%D9%87%D9%88%D9%86%D8%AF%D8%A7%D9%8A+%D8%A5%D9%84%D9%86%D8%AA%D8%B1%D8%A7+-+Hyundai+Elantra+2013-94.wmv',
				'video_duration' => '',
				'tags' => json_encode(array('car','mobile')), 
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),
			array(
				'title' => 'هونداي إلنترا - Hyundai Elantra 2012-90',
				'description' => 'This is a sample description',
				'name' => 'هونداي إلنترا - Hyundai Elantra 2012-90.mp4',
				'url' => 'https://s3-us-west-2.amazonaws.com/vidorabia/%D9%87%D9%88%D9%86%D8%AF%D8%A7%D9%8A+%D8%A5%D9%84%D9%86%D8%AA%D8%B1%D8%A7+-+Hyundai+Elantra+2012-90.mp4',
				'video_duration' => '',
				'tags' => json_encode(array('car','mobile')), 
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),
			array(
				'title' =>'نيسان صني - Nissan Sunny 2012-108',
				'description' => 'This is a sample description',
				'name' => 'نيسان صني - Nissan Sunny 2012-108.mp4',
				'url' => 'https://s3-us-west-2.amazonaws.com/vidorabia/%D9%86%D9%8A%D8%B3%D8%A7%D9%86+%D8%B5%D9%86%D9%8A+-+Nissan+Sunny+2012-108.mp4',
				'video_duration' => '',
				'tags' => json_encode(array('car','mobile')), 
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),
			array(
				'title' =>'نيسان باثفايندر - Nissan Pathfinder 2011-97',
				'description' => 'This is a sample description',
				'name' => 'نيسان باثفايندر - Nissan Pathfinder 2011-97.mp4',
				'url' => 'https://s3-us-west-2.amazonaws.com/vidorabia/%D9%86%D9%8A%D8%B3%D8%A7%D9%86+%D8%A8%D8%A7%D8%AB%D9%81%D8%A7%D9%8A%D9%86%D8%AF%D8%B1+-+Nissan+Pathfinder+2011-97.mp4',
				'video_duration' => '',
				'tags' => json_encode(array('car','mobile')), 
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),
			array(
				'title' =>'مهارات وأهداف المايسترو الإسباني تشافي هيرنانديز 2014-83',
				'description' => 'This is a sample description',
				'name' => 'مهارات وأهداف المايسترو الإسباني تشافي هيرنانديز 2014-83.mp4',
				'url' => 'https://s3-us-west-2.amazonaws.com/vidorabia/%D9%85%D9%87%D8%A7%D8%B1%D8%A7%D8%AA+%D9%88%D8%A3%D9%87%D8%AF%D8%A7%D9%81+%D8%A7%D9%84%D9%85%D8%A7%D9%8A%D8%B3%D8%AA%D8%B1%D9%88+%D8%A7%D9%84%D8%A5%D8%B3%D8%A8%D8%A7%D9%86%D9%8A+%D8%AA%D8%B4%D8%A7%D9%81%D9%8A+%D9%87%D9%8A%D8%B1%D9%86%D8%A7%D9%86%D8%AF%D9%8A%D8%B2+2014-83.mp4',
				'video_duration' => '',
				'tags' => json_encode(array('carh','mobile')), 
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s')),


			);
			$i = 0;*/
			/*foreach($videos as $v){
				$i++;
				$user_id = User::where('username', 'admin')->first()->id;
				$channel_id = UserChannel::where('user_id', $user_id)->first()->channel_id;
				$s3_url = 'https://s3-us-west-2.amazonaws.com/vidorabia.test';


				$name = 'car_'.$i.'.jpg';

				$v['thumbnail'] = $s3_url.'/'.$channel_id.'/thumbnails/'.$name; 
				$video_id = DB::table('videos')->insertGetId($v);

				$channel = array(
					'video_id' => $video_id,
					'channel_id' => $channel_id,
				);

				DB::table('channels')->insertGetId($channel);

				$category = array(
					'category_id' => 2,
					'video_id' => $video_id
				);

				DB::table('video_categories')->insertGetId($category);
			}*/