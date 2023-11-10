<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Item;
use App\Models\Product;
use App\Models\Passport;
use App\Models\PassportOrder;
use App\Models\PassportUsedOrder;
use App\Models\Coupon;
use App\Models\GeneralSetting;

use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CronController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // echo '<pre>'; print_r($data['products']->toArray()); die;
        // return view('home',$data);
    }

    public function get_insta_feed(Request $request)
    {
        $setting_data = GeneralSetting::all();
        $settings=array();
        foreach($setting_data as $set){
            $settings[$set->meta_key]=$set->meta_value;
        }
        $data = file_get_contents("https://graph.facebook.com/v12.0/17841421607938893?fields=biography,followers_count,follows_count,ig_id,media_count,name,profile_picture_url,username,stories,tags,media,live_media&transport=cors&access_token=".$settings['insta_access_token']);

        $insta_data = json_decode($data);
        // echo '<pre>data - '; print_r($insta_data); die;
        // echo '<pre>data - '; print_r($insta_data->media->data[0]); die;
    
        $m_data_arr = array();
    
        foreach($insta_data->media->data as $k => $media){
            $m_data = file_get_contents("https://graph.facebook.com/v12.0/".$media->id."?fields=media_product_type,media_url,media_type,username,thumbnail_url,video_title&transport=cors&access_token=".$settings['insta_access_token']);
             $m_data_arr[$k] = json_decode($m_data);
    
             $ins_data = array(
                'feed_id' => $m_data_arr[$k]->id,
                'media_product_type' => $m_data_arr[$k]->media_product_type,
                'media_type' => $m_data_arr[$k]->media_type,
                'username' => $m_data_arr[$k]->username,
                'media_url' => $m_data_arr[$k]->media_url,
                'status' => 1,
                'created_at' => time(),
                'updated_at' => time(),
             );
             // echo '<pre>ins_data - '; print_r($ins_data); //die;
            //  $fields = '`' . implode('`, `', array_keys($ins_data)) . '`';
            //  $ndata = '\'' . implode('\', \'', $ins_data) . '\'' ;
    
            //  $this->checkFeed($m_data_arr[$k]->id,$ins_data);
        }
        echo '<pre>m_data_arr - '; print_r($m_data_arr); die;
    }

    
    function checkFeed($id,$insArr=array()){
        $instafeed = DB::table('insta_feeds')->where('feed_id',$id)->first();

        if($instafeed){
            return false;
        }else{
            DB::table('insta_feeds')->insert($insArr);
            return true;
        }
    }

}
