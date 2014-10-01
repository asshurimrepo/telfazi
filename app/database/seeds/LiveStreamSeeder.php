<?php 

class LiveStreamSeeder extends Seeder{
	public function run(){
		/*$data = array(
			array(
				'title' => 'Palestenian Channels',
				'sub_name' => 'قناة الفلسطينية - البث المباشر',
				'description' => 'رام الله, فلسطين عمارة برج الشيخ - الطابق السابع',
				'video_url' => 'http://46.43.64.166:1935/flv/flv/playlist.m3u8',
				'thumbnail_url' => 'Palestenian_Channels.jpg',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 'is_stream' => 1),
			array(
				'title' => 'Syrian Channels',
				'sub_name' => 'قناة تلاقي - البث المباشر',
				'description' => 'تعريف قناة تلاقي حسب موقعهم:
<br>
تلاقي قناة فضائية سورية … غايتها زيادة التواصل مع الناس,وبينهم من أجل مجتمع أفضل.
سينقل رسالتنا فريق شاب مدرب ومؤهل ..و سوري..
تلاقي.. هي صورة عن حياة السوريين., ماضياً وحاضراً ومستقبلاً, في الفكر والسياسة والاقتصاد والثقافة بكل ما في هذه الحياة من بساطة وعمق وغنى وتنوع… بكل ما فيها …من إنسانية.
تلاقي… ستتابعونها على الأقمار الصناعية, والإنترنت, والهاتف المحمول لنقدم الخدمة الأفضل في التواصل والتلاقي مع المشاهد.
تلاقي… حيث يجب أن نلتقي.
',
				'video_url' => 'rtmp://82.137.248.20:1935/Talaqie/TalaqieLive2',
				'thumbnail_url' => 'Syrian_Channels.jpg',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 'is_stream' => 1),
			array(
				'title' => 'Egyptian Channels',
				'sub_name' => 'التلفزيون المصري - القناة المصرية',
				'description' => '',
				'video_url' => 'rtmp://38.111.46.93:1935/masriya/livestream',
				'thumbnail_url' => 'Egyptian_Channels.jpg',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 'is_stream' => 1),
			array(
				'title' => 'Emirati Channels',
				'sub_name' => 'تلفزيون سما دبي مباشر',
				'description' => '',
				'video_url' => 'http://cdnedvrsamadubai.endavomedia.com/smil:dmilivesamadubaihls.smil/playlist.m3u8',
				'thumbnail_url' => 'sama-dubai-300x201.png',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 'is_stream' => 1),
			array(
				'title' => 'Arabic Channels / Emirati Channels',
				'sub_name' => 'Dubai TV - قناة دبي الفضائية مباشر',
				'description' => 'شاهد تلفزيون قناة دبي الفضائية مباشر',
				'video_url' => 'http://cdnedvrdubaitv.endavomedia.com/smil:dmilivedubaitvhls.smil/playlist.m3u8',
				'thumbnail_url' => 'dubaitv.jpg',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 'is_stream' => 1),
			array(
				'title' => 'Arabic Channels / Islamic Channels',
				'sub_name' => 'قناة نور دبي مباشر',
				'description' => 'مشاهدة مباشرة لتلفزيون قناة نور دبي الدينية',
				'video_url' => 'http://cdnedvrnoordubaitv.endavomedia.com/smil:dmilivenoordubaitvhls.smil/playlist.m3u8',
				'thumbnail_url' => 'nourdubai.jpg',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 'is_stream' => 1),
			array(
				'title' => 'Iraqi Channels / Kurd TV',
				'sub_name' => 'Kurdistan TV',
				'description' => '',
				'video_url' => 'rtmp://84.244.187.12/live/livestream',
				'thumbnail_url' => 'kurdstantv.jpg',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 'is_stream' => 1)
			);
		

		foreach ($data as $d) {
			$v = new Video();
			$v->is_stream = 1;
			$v->save();

			$c = new Channel();
			$c->channel_id = 1;
			$c->video_id = $v->id;
			$c->save();

			$d['video_id'] = $v->id;
			$id = DB::table('livestreams')->insertGetId($d);	
		}*/

		//DB::table('livestreams')->insert($data);

		$data = array(
			/*array(
				'title' => 'Palestenian Channels',
				'sub_name' => 'قناة الفلسطينية - البث المباشر',
				'description' => 'رام الله, فلسطين عمارة برج الشيخ - الطابق السابع',
				'video_url' => 'http://46.43.64.166:1935/flv/flv/playlist.m3u8',
				'thumbnail_url' => 'Palestenian_Channels.jpg',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 'is_stream' => 1),*/
			array(
				'title' => 'Syrian Channels',
				'sub_name' => 'قناة تلاقي - البث المباشر',
				'description' => 'تعريف قناة تلاقي حسب موقعهم:
<br>
تلاقي قناة فضائية سورية … غايتها زيادة التواصل مع الناس,وبينهم من أجل مجتمع أفضل.
سينقل رسالتنا فريق شاب مدرب ومؤهل ..و سوري..
تلاقي.. هي صورة عن حياة السوريين., ماضياً وحاضراً ومستقبلاً, في الفكر والسياسة والاقتصاد والثقافة بكل ما في هذه الحياة من بساطة وعمق وغنى وتنوع… بكل ما فيها …من إنسانية.
تلاقي… ستتابعونها على الأقمار الصناعية, والإنترنت, والهاتف المحمول لنقدم الخدمة الأفضل في التواصل والتلاقي مع المشاهد.
تلاقي… حيث يجب أن نلتقي.
',
				'video_url' => 'rtmp://82.137.248.20:1935/Talaqie/TalaqieLive2',
				'thumbnail_url' => 'Syrian_Channels.jpg',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 'is_stream' => 1),
			array(
				'title' => 'Egyptian Channels',
				'sub_name' => 'التلفزيون المصري - القناة المصرية',
				'description' => '',
				'video_url' => 'rtmp://38.111.46.93:1935/masriya/livestream',
				'thumbnail_url' => 'Egyptian_Channels.jpg',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 'is_stream' => 1),
			array(
				'title' => 'Emirati Channels',
				'sub_name' => 'تلفزيون سما دبي مباشر',
				'description' => '',
				'video_url' => 'http://cdnedvrsamadubai.endavomedia.com/smil:dmilivesamadubaihls.smil/playlist.m3u8',
				'thumbnail_url' => 'sama-dubai-300x201.png',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 'is_stream' => 1),
			array(
				'title' => 'Arabic Channels / Emirati Channels',
				'sub_name' => 'Dubai TV - قناة دبي الفضائية مباشر',
				'description' => 'شاهد تلفزيون قناة دبي الفضائية مباشر',
				'video_url' => 'http://cdnedvrdubaitv.endavomedia.com/smil:dmilivedubaitvhls.smil/playlist.m3u8',
				'thumbnail_url' => 'dubaitv.jpg',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 'is_stream' => 1),
			array(
				'title' => 'Arabic Channels / Islamic Channels',
				'sub_name' => 'قناة نور دبي مباشر',
				'description' => 'مشاهدة مباشرة لتلفزيون قناة نور دبي الدينية',
				'video_url' => 'http://cdnedvrnoordubaitv.endavomedia.com/smil:dmilivenoordubaitvhls.smil/playlist.m3u8',
				'thumbnail_url' => 'nourdubai.jpg',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 'is_stream' => 1),
			array(
				'title' => 'Iraqi Channels / Kurd TV',
				'sub_name' => 'Kurdistan TV',
				'description' => '',
				'video_url' => 'rtmp://84.244.187.12/live/livestream',
				'thumbnail_url' => 'kurdstantv.jpg',
				'created_at' => date('Y-m-d H:i:s'),
				'updated_at' => date('Y-m-d H:i:s'), 'is_stream' => 1)
			);
		

		foreach ($data as $d) {
			$video_id = DB::table('videos')->insertGetId($data);

			$c = new Channel();
			$c->channel_id = 1;
			$c->video_id = $video_id;
			$c->save();
		}
	}
}