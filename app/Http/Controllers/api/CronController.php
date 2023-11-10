<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use DB;
use Storage;
use Response;

class CronController extends Controller
{
    public function index(){
		
		$result_decode = $this->fetchData();
		//echo '<pre>';print_R($result_decode);die;
		if(isset($result_decode["data"]) AND COUNT($result_decode["data"]) > 0){
			DB::table('insta_feeds')->delete();
			//echo '<pre>';print_R($result_decode["data"]);die;
			foreach($result_decode["data"] as $post){
				//echo '<pre>';print_R($post);die;
				
				$feed_id = $post["id"];
				$caption = $post["caption"];
				$permalink = $post["permalink"];
				$media_type = $post["media_type"];
				$media_url = $post["media_url"];
				$timestamp = $post["timestamp"];
				if ($media_type == "VIDEO" ) {
					$media_url = $post["thumbnail_url"]; }
				  else {
					$media_url = $post["media_url"];
				  }
  
				 $ins_data = array(
					'feed_id' => $feed_id,
					'media_type' => $media_type,
					'media_url' => $media_url,
					'status' => 1,
					'caption' => $caption,
					'permalink' => $permalink,
					'post_time' => date('Y-m-d H:i:s',strtotime($timestamp)),
					'created_at' => time(),
					'updated_at' => time(),
				);
				//echo '<pre>';print_r($ins_data);die;
				DB::table('insta_feeds')->insert($ins_data);
			}
		
		}
		
		
    }
	
	
	
	function fetchData(){
		
		$token_data = DB::table('general_settings')->select('meta_value')->where('meta_key','instagram_token')->first();
		$token = $token_data->meta_value;
		
		$token='IGQVJYWmw5R29ScmM3YUNaS2lCQ3VJekF0bmlsRWFqa3BYejVOTFlxWXgzUGhJWFBWQ2U1SG9qNUhSOUxwcmMxUzByZAnZA4NDdVZAlBzREx6akhkZAUlHZA0oyLXE4a2FuRVkzU1l0SlZA4bmxnaGJqbnAtRQZDZD';

		$fields = "id,media_type,media_url,thumbnail_url,timestamp,permalink,caption";
		$limit = 12; 

		$url = "https://graph.instagram.com/me/media?fields={$fields}&access_token={$token}&limit={$limit}";
		
		
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, $url);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($ch, CURLOPT_TIMEOUT, 20);
	  $result = curl_exec($ch);
	  curl_close($ch);
	  return $result_decode = json_decode($result, true);
	  
  }


}