<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use DB;

class CronController extends Controller
{
    public function index(){
		$curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://instagram85.p.rapidapi.com/account/finchbrewcafe/feed?by=username',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'X-RapidAPI-Host: instagram85.p.rapidapi.com',
            'X-RapidAPI-Key: 21c85ceac3msh82a1dc6e000f5d7p1628d1jsnf4c3ea9cfc0a'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $res = json_decode($response , true);
        // echo "<pre>";print_R($res);die;
        foreach($res['data'] as $feed_data){
           $feed_id = $feed_data['id'];
           $username = $feed_data['owner']['username'];
           $post_time = $feed_data['created_time']['string'];
           $post_type = $feed_data['type'];
           $post_url = $feed_data['post_url'];
           $post_images_url = $feed_data['images']['square']['3'];
           $post_caption = $feed_data['caption'];
           $post_likes = $feed_data['figures']['likes_count'];
           $post_comments = $feed_data['figures']['comments_count'];

            $ins_data = array(
            'feed_id' => $feed_id,
            'media_type' => $post_type,
            'username' => $username,
            'media_url' => $post_images_url,
            'status' => 1,
            'post_time' => $post_time,
            'post_url' => $post_url,
            'post_caption' => $post_caption,
            'like_count' => $post_likes,
            'comments_count' => $post_comments,
            'created_at' => time(),
            'updated_at' => time(),
        );
        $instaPosts = DB::table('insta_feeds')->where('status',1)->get();
         foreach($instaPosts as $feed_tableData){
          $fdID =   $feed_tableData->feed_id;
          if ($fdID != $feed_id) {
            DB::table('insta_feeds')->insert($ins_data);
          }
        }
            
        }
    }

}