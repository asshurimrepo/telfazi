<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
//Base
Route::get('404', 'BaseController@pageNotFound');

//Test
Route::get('test', 'TestController@test');
Route::get('seourlgenerate', 'TestController@seoUrlGenerate');
Route::post('test', 'TestController@postTest');


//Front
Route::get('/', 'FrontController@home');
Route::get('mustwatch', 'FrontController@showMustWatch');
Route::get('feature_videos', ['as' => 'video_feature_partial', 'uses' => 'FrontController@getFeatureVideos']);
Route::get('feature_category', ['as' => 'video_category_partial', 'uses' => 'FrontController@getFeatureCategory']);
Route::get('feature_livestream', ['as' => 'video_livestream_partial', 'uses' => 'FrontController@getFeatureLiveStream']);
Route::get('videos/{sortby?}', 'FrontController@getVideosBy');
Route::get('login', 'FrontController@login');
Route::get('logout', 'FrontController@logout');
Route::post('login/auth', 'FrontController@log_auth');
Route::post('login/fb', 'FrontController@log_fb');


//Dashboard 
Route::get('dashboard', 'DashboardController@dashboard');

//Admin
Route::get('allvids', 'AdminController@allVideos');
Route::post('allvids', 'AdminController@allVideosPost');

//User Controller
Route::get('mytv', 'UserController@myDashboad');
Route::post('mytv', 'UserController@myDashboardManage');
Route::get('user/{username}', 'UserController@userDashboad'); //viewing
Route::get('mytv/profile', 'UserController@myProfile');
Route::get('mytv/subscriptions', 'UserController@mySubscriptions');
Route::post('mytv/subscriptions', 'UserController@mySubscriptionsManage');
Route::get('mytv/channels', 'UserController@myChannels');
Route::get('channels/{username}', 'UserController@myChannels'); //viewing
Route::get('mytv/liked', 'UserController@myLikedVideos');
Route::get('liked/{username}', 'UserController@myLikedVideos'); //viewing
Route::post('mytv/liked', 'UserController@likedTable');
Route::get('mytv/videos', 'UserController@myVideos');

Route::post('mytv/videos', 'UserController@myVideosPost');
Route::get('mytv/play/{type?}', 'UserController@myPlaylist');
Route::post('mytv/play', 'UserController@myPlaylistManage');
Route::post('mytv/channels/create', 'UserController@createChannel');
Route::get('mytv/channels/edit/{channel_id}', 'UserController@editChannel');
Route::post('mytv/channels/save', 'UserController@saveChannel');
Route::post('mytv/channels/image', 'UserController@updateChannelPicture');
Route::post('mytv/profile/save', 'UserController@updateProfile');
Route::post('mytv/profile/image', 'UserController@updateProfilePicture');

//Registration
Route::get('register/{type?}', 'RegistrationController@register_user');
Route::post('user/delete', 'RegistrationController@delete_user');
Route::post('user/store', 'RegistrationController@store_user');
Route::post('user/update', 'RegistrationController@update_user');


//Reminders
Route::get('password/reset', 'RemindersController@getRemind');
Route::get('password/reset/{token}', 'RemindersController@getReset');
Route::post('password/update', 'RemindersController@postReset');
Route::post('password/request', 'RemindersController@postRemind');


//Setting
Route::get('settings', 'SettingController@showUserSettings');
Route::get('settings/account', 'SettingController@edit_account');
Route::get('settings/password', 'SettingController@getChangePassword');
Route::get('settings/categories', 'SettingController@categories');
Route::post('settings/password', 'SettingController@postChangePassword');


//Video 
Route::get('video/{id}', 'VideoController@video');
Route::get('watch/{id?}', 'VideoController@watchVideo');
Route::get('category', 'VideoController@viewCategory');

Route::post('editVideo', 'VideoController@postEditVideo');
Route::post('editVid', 'VideoController@requestEditVideo');

Route::get('videotag/{tagname}', 'VideoController@showVideosByTag');

//VideoBrowse
Route::get('browsevids/{filter?}/{id?}', ['as' => 'browse_videos_page', 'uses' => 'VideoBrowseController@showBrowseVideos']);
Route::get('browse/{filter?}/{id?}', ['as' => 'browse_videos', 'uses' => 'VideoBrowseController@browseVideos']);
Route::post('browse', 'VideoBrowseController@browseVideosPost');

//VideoDetail 
$c = 'VideoDetailController';
Route::get('video/translate/{id}', $c.'@videoTranslate');
Route::post('video/translate/{id}', $c.'@videoTranslatePost');
Route::delete('video/translate/{id}', $c.'@videoTranslateDelete');
Route::get('video/manage/{id}', $c.'@videoManage');
Route::get('video/edit/{id}', $c.'@videoDetail');
Route::post('video/save/{id}', $c.'@videoDetailSave');

//VideoUpload
Route::get('upload', 'VideoUploadController@create');
Route::get('upload/{channelID?}', 'VideoUploadController@index');
Route::get('recentuploads', 'VideoUploadController@postRecentVideos');
Route::get('s3callback', 'VideoUploadController@s3upload_callback');
Route::post('saveVideo/{channelID}', 'VideoUploadController@saveVideo');
Route::post('upload', 'VideoUploadController@upload_video');

//Channel 
Route::get('channels/{filter?}/{id?}', 'ChannelController@channels');
Route::get('channel/{channel_id}', 'ChannelController@viewChannel');
Route::get('channel/{channel_id}/subscribe', 'ChannelController@subscribe');
Route::post('channel/subsTo', 'ChannelController@subscribeTo');


//Request
$controller = 'RequestController';
Route::get('tags', $controller.'@requestTags');
Route::get('categories', $controller.'@requestCategories');
Route::get('relatedvids/{id}', $controller.'@requestRelatedVids');
Route::get('getprofilestats', $controller.'@getUserStats');
Route::get('getvideotags', $controller.'@getVideoTags');
Route::post('likes', $controller.'@videoLikes');
Route::get('reportTo', $controller.'@reportVideoTo');
Route::get('addto', $controller.'@addToPlaylist');
Route::post('report',$controller.'@reportVideo');
Route::post('addToList', $controller.'@getPlaylists');
Route::get('page', $controller.'@paginateVideos');
Route::post('postTest', $controller.'@postTest');



//SearchController
Route::get('query', 'SearchController@index');
Route::get('search', 'SearchController@searchQuery');
Route::post('mysearch', 'SearchController@searchMyVideos'); // searching function in user videos


//StreamController
Route::get('live/{id?}', 'StreamController@showStreamVideos');
Route::get('streamreader', 'StreamController@streamReader');




Route::get('phpinfo', function(){
    phpinfo();
});