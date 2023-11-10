<?php
use App\Models\Hop;
use App\Models\Malt;
use App\Models\UploadImage;
use App\Models\Passport;
use App\Models\PassportOrder;
use App\Models\Product;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

function get_malt_explode($ids){
    $name =array();
    $id_arr  =explode(',',$ids);
    $data = Malt::whereIn('id',$id_arr)->get();
    foreach($data as $row){
        $name[]=$row->name;
    }
    return implode(',',$name);
}

function get_hop_explode($ids){
    $name =array();
    $id_arr  =explode(',',$ids);
    $data = Hop::whereIn('id',$id_arr)->get();
    foreach($data as $row){
        $name[]=$row->name;
    }
    return implode(',',$name);
}


function get_place_image_explode($ids){
    $images =array();
    $id_arr  =explode(',',$ids);
    $data = UploadImage::whereIn('id',$id_arr)->get();
    foreach($data as $row){
        $images[]=asset($row->file);
    }
    return $images;
}


function generatePassportId(){
        $rand = rand(10,9999).rand(100,9999);
        $row = Passport::where('passport_id',$rand)->get();

        if(isset($row  ) && empty($row->toArray())){
            return $rand;
        }else{
            $this->generatetId();
        }
    }

function generatePassportCode(){
        $rand = rand(10,9999).rand(100,9999);
        $row = PassportOrder::where('passport_code',$rand)->get();

        if(isset($row  ) && empty($row->toArray())){
            return $rand;
        }else{
            $this->generatetId();
        }
    } 
    
    
function getProductDetail($id){
        $product_arr =array();
        $product = Product::find($id);

        $product_arr=$product; 
        $product_arr['image']=asset($product->FileId->file); 
        $product_arr['type_name']=$product->Type->name; 
        $product_arr['category_name']=$product->Category->name; 
        $product_arr['place_name']=$product->Place->name; 
        $product_arr['location_name']=$product->Place->Location->name; 
       
         if($product->type ==1){
                $product_arr['malts']=get_malt_explode($product->malt); 
                $product_arr['hops']=get_hop_explode($product->hops); 
            }else{
                unset($product_arr['hops']);
                unset($product_arr['malt']);
                unset($product_arr['quantity']);
                unset($product_arr['percentage']);
                unset($product_arr['color']);
                unset($product_arr['orignal_gravity']);
                unset($product_arr['style']);
            }

        unset($product_arr['created_at']);
        unset($product_arr['updated_at']);
        unset($product_arr['status']);
        return $product_arr->toArray();
    }   
    
    function getSiteSettings(){
        
        $setting_data = GeneralSetting::all();
        foreach($setting_data as $set){
            $settings[$set->meta_key]=$set->meta_value;
        }
        $site_image = UploadImage::where('id',$settings['site_logo'])->first();
        $settings['site_image'] = $site_image;
        return $settings; 
    }




    function sendNotification($title = "", $body = "", $customData = ["new_post_id" => "605"], $topic = "", $serverKey = "AAAAu0Yikwg:APA91bFR7-rPhMiU9rE0pgEo1snj7xXJ_jOuX8GcjG05r0LYFSiUPPSCD8QvjOvoOIlAJdUd25PRZlMvA9CXmY9fAXe-CmH4yRKHCg5FmArysCAzs9Cpg4sLOz7Kb4tiF0kOooO23n06")
    { //echo"a";die;
            if($serverKey != ""){
            ini_set("allow_url_fopen", "On");
            $data =
            [
            "to" => '/topics/'.$topic,
            "notification" => [
            "body" => $body,
            "title" => $title,
            ]
            ];

            $options = array(
            'http' => array(
            'method' => 'POST',
            'content' => json_encode( $data ),
            'header'=> "Content-Type: application/json\r\n" .
            "Accept: application/json\r\n" .
            "Authorization:key=".$serverKey
            )
            );

            $context = stream_context_create( $options );
            $result = file_get_contents( "https://fcm.googleapis.com/fcm/send", false, $context );
            // echo "<pre>"; print_r(json_decode( $result ));
            }
            return true;
        }

        function uploadImage(Request $request)
        {
        
            $type = $request->type;
            $path = $type . '_path';
            $name = $type . '_name';
        
            $file_path = $request->$path;
            $file_name = $request->$name;
        
            if (!empty($request->file($file_name))) {
                $file = $request->file($file_name);
                $file_name = time() . "-" . '.webp';
                $optimizedImage = Image::make($file)
                    ->encode('webp', 80);
                $optimizedImage->save(public_path($file_path . $file_name));
        
        
                $file_data = UploadImage::create([
                    'file' =>  $file_path . $file_name,
                ]);
        
        
        
                return response()->json(['status' => 1, 'file_id' => $file_data->id, 'file_path' => asset($file_data->file)]);
            } else {
                return response()->json(['status' => 0, 'msg' => 'File type not allowed']);
            }
        }