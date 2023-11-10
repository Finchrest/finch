<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Hop;
use App\Models\Malt;
use App\Models\Ptype;
use App\Models\UploadImage;
use App\Models\Location;
use App\Models\Place;
use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\ProductMeta;
use App\Models\PassportFreeItem;

use Validator;
use Illuminate\Support\Facades\Hash;

class ProductsController extends Controller
{
    protected $page;
    protected $module;
    protected $modal;
    protected $route;


    public function __construct()
    {
        $this->page = new \stdClass;
        $this->modal = 'App\Models\Product';
        $this->route = new \stdClass;
        $this->module = 'Product';
        $this->route->list = route('admin.products.list');
        $this->route->add = route('cproducts.create');
        $this->route->store = route('cproducts.store');
        $this->route->edit = route("cproducts.edit", ":id");
        $this->route->destroy = route("cproducts.destroy", ":id");
        $this->route->upload = route("cproducts.upload");
        $this->route->freeList = route('admin.freeproducts.list');
        $this->route->freeAdd = route('cproducts.createfreeproduct');
        $this->route->status = route('admin.cproducts.status');
        $this->route->freeProductstatus = route('admin.freeproducts.status');
    }

    public function index()
    {
        //echo $this->route->add;die;
        $this->page->title = $this->module . 's List';
        return view('admin.' . $this->module . '.index', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module]);
    }


    public function list(Request $request)
    {
        ## Read value
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value


        $totalRecords = $this->modal::where('for_passport', 0)->count();

        $totalRecordwithFilter = $totalRecords;

        $qry = $this->modal::select('products.*', 'locations.name')->where('for_passport', 0)->offset($row)->take($rowperpage);

        if ($searchValue) {
            $qry->where(function ($query) use ($searchValue) {
                $query->where('title', 'like', '%' . $searchValue . '%')
                    ->orWhere('sub_title', 'like', '%' . $searchValue . '%')
                    ->orWhere('locations.name', 'like', '%' . $searchValue . '%');
            });
        }

        $qry->leftJoin('locations', 'locations.id', '=', 'products.location');
        $qry->orderBy('id', 'DESC');

        $result = $qry->get();

        $data = array();
        $i = 1;
        // echo '<pre>result - '; print_r($result->toArray()); die;
        foreach ($result as $row) {
            $status_url = $this->route->status;
            if ($row->status == 1) {
                $status = '<div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="switch2" checked="" onchange=status_change("' . $status_url . '",this,' . $row->id . ');>
  <label class="custom-control-label" for="switch2"></label>
</div>';
            } else {
                $status = '<div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="switch2" onchange=status_change("' . $status_url . '",this,' . $row->id . ');>
  <label class="custom-control-label" for="switch2"></label>
</div>';
            }


            $action = '';
            $edit_url = $this->route->edit;
            $destroy_url = $this->route->destroy;
            $action .= '<a href="#!" onclick=productDuplicate(this,' . $row->id . ');><i class="fa fa-copy"></i></a>';
            $action .= '&nbsp;&nbsp;<a href="#!" onclick=edit_row("' . $edit_url . '",' . $row->id . ');><i class="fa fa-edit"></i></a>';
            $action .= '&nbsp;&nbsp;<a href="#!" class="text-danger" onclick=delete_row("' . $destroy_url . '",' . $row->id . ')><i class="text-danger fa fa-trash"></i></a>';

            $file = '<img src="' . asset('images/no_image.jpg') . '"  class="img-thumbnail " alt="" width="50" height="50">';
            if ($row->FileId) {
                $file = '<img src="' . asset($row->FileId->file) . '"  class="img-thumbnail " alt="" width="50" height="50">';
            }

            if (!empty($row->category)) {
                $cat = $row->Category->name;
            } else {
                $cat = '';
            }

            if (!empty($row->sub_category)) {
                $sub_cat = $row->SubCategory->name;
            } else {
                $sub_cat = '';
            }

            // echo "<pre>";print_r($row->Place->name);die;
            if (@$row->Place->name == null) {
                $placeName = '';
            } else {
                $placeName = $row->Place->name;
            }

            $data[] = array(
                "sno" => $i,
                "title" => $file . ' ' . $row->title,
                "sub_title" => $row->sub_title,
                "place" => ucwords($placeName), //ucwords($row->Place->name).', '.ucwords($row->name),
                "type" => @$row->Type->name,
                "category" => $cat,
                "sub_category" => $sub_cat,
                "price" => '₹' . $row->price,
                "tax" => $row->tax . '%',
                "total_price" => '₹' . $row->total_price,
                "status" => $status,
                "created_at" => date('Y-m-d h:i A', strtotime($row->created_at)),
                "action" => $action,
            );

            $i++;
        }


        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }

    public function create()
    {
        $categories = Category::get();
        $locations = Location::get();
        $places = Place::get();
        $hops = Hop::get();
        $malts = Malt::get();
        $ptypes = Ptype::get();

        $qry = Attribute::select('attributes.id', 'attributes.name', 'attributes.status');
        $qry->groupBy('attributes.id');
        $qry->groupBy('attributes.name');
        $qry->groupBy('attributes.status');
        $qry->selectRaw('GROUP_CONCAT(attribute_options.option_name) as options');
        $qry->selectRaw('GROUP_CONCAT(attribute_options.id) as option_ids');

        $qry->leftJoin('attribute_options', 'attribute_options.attr_id', '=', 'attributes.id');
        $qry->where('attributes.is_delete', 0);
        $qry->where('attribute_options.is_delete', 0);

        $qry->orderBy('attributes.id', 'ASC');

        $result = $qry->get();

        $attr_arr = $result->toArray();

        $attr_json = json_encode(array('data' => $attr_arr));

        //echo '<pre>result - '; print_r($attr_json); die;

        return view('admin.' . $this->module . '.add', [
            'route' => $this->route,
            'module' => $this->module,
            'categories' => $categories,
            'hops' => $hops,
            'malts' => $malts,
            'ptypes' => $ptypes,
            'places' => $places,
            'locations' => $locations,
            'attributes' => $attr_json,
        ]);
    }



    public function store(Request $request)
    {
        if ($request->for_passport == 0) {

            if ($request->is_product_attr > 0) {
                /*$validator =Validator::make($request->all(),
            [
                'attr_regular_price[]' => 'required',
                'attr_tax_price[]' => 'required',
                'attr_total_price[]' => 'required',
            ]);*/
            } else {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'price' => 'required',
                        'tax' => 'required',
                        'total_price' => 'required',
                    ]
                );
                if ($validator->fails()) {
                    return $validator->validate();
                }
            }

            $id = $request->id;
            if ($id) {
                return $this->update_data($request);
            } else {
                $hops = $malt = '';
                if ($request->ptype == 1) {
                    $validator = Validator::make(
                        $request->all(),
                        [
                            'title'          => 'required',
                            'short_description'   => 'required',
                            'description'   => 'required',
                            'file_id'        => 'required',
                            'file_id_2'        => 'required',
                            /*'price' =>'required',
                    'tax' =>'required',
                    'total_price' =>'required',*/
                            'category' => 'required',
                            'place' => 'required',
                            'is_veg' => 'required',
                        ],
                        [
                            'file_id.required' => 'Product Image is required!',
                            'file_id_2.required' => 'Badge Image is required!',
                        ]
                    );
                    if ($request->hops) {
                        $hops = implode(',', $request->hops);
                    }

                    if ($request->malt) {
                        $malt = implode(',', $request->malt);
                    }
                } else {
                    $validator = Validator::make(
                        $request->all(),
                        [
                            'title'          => 'required',
                            'short_description'   => 'required',
                            'description'   => 'required',
                            'file_id'        => 'required',
                            /*'price' =>'required',
                    'tax' =>'required',
                    'total_price' =>'required',*/
                            'category' => 'required',
                            'place' => 'required',
                            'is_veg' => 'required',
                        ]
                    );
                }

                if ($validator->fails()) {
                    return $validator->validate();
                } else {
                    $id = 0;
                    $places = $request->place;
                    foreach ($places as $place) {

                        $place_loc = Place::where('id', $place)->first();

                        $obj = $this->modal::firstOrNew(['id' => $id]);
                        $obj->title = $request->title;
                        $obj->sub_title = $request->sub_title;
                        $obj->short_description = $request->short_description;
                        $obj->description = $request->description;
                        $obj->category = $request->category;
                        $obj->sub_category = $request->sub_category;
                        $obj->file_id = $request->file_id;
                        $obj->badge_file = $request->file_id_2;
                        $obj->price = $request->price;
                        $obj->tax = $request->tax;
                        $obj->total_price = $request->total_price;
                        $obj->is_veg = $request->is_veg;
                        $obj->hops = $hops;
                        $obj->malt = $malt;
                        $obj->quantity = $request->quantity;
                        $obj->percentage = $request->percentage;
                        $obj->color = $request->color;
                        $obj->orignal_gravity = $request->orignal_gravity;
                        $obj->style = $request->style;
                        $obj->status = $request->status;
                        $obj->type = $request->ptype;
                        $obj->place = $place;
                        $obj->location = $place_loc->location;
                        $obj->stock = $request->stock;
                        $obj->for_passport = $request->for_passport;

                        $is_product_attr = $request->is_product_attr;
                        if ($is_product_attr !== '0') {
                            $obj->price = $request->attr_regular_price[0];
                            $obj->tax = $request->attr_tax_price[0];
                            $obj->total_price = $request->attr_total_price[0];
                            $obj->is_product_attr = 1;
                            $obj->attribute_id = $is_product_attr;
                            $obj->option_id = $request->attr_options_id[0];
                            //echo "<pre>";print_R($obj);die;                  
                        } else {
                            $obj->price = $request->price;
                            $obj->tax = $request->tax;
                            $obj->total_price = $request->total_price;
                            $obj->is_product_attr = 0;
                            $obj->attribute_id = 0;
                            $obj->option_id = 0;
                        }

                        $obj->save();

                        if ($is_product_attr !== '0') { // echo"a";die;
                            for ($i = 0; $i < count($request->attr_options_id); $i++) {
                                $obj2 = ProductMeta::firstOrNew(
                                    [
                                        'product_id' => $obj->id,
                                        'option_id' => $request->attr_options_id[$i]
                                    ]
                                );
                                $obj2->attribute_id = $is_product_attr;
                                $obj2->regular_price = $request->attr_regular_price[$i];
                                $obj2->tax = $request->attr_tax_price[$i];
                                $obj2->created_at = date('Y-m-d h:i A', time());
                                $obj2->updated_at = date('Y-m-d h:i A', time());
                                $obj2->save();
                            }
                        }
                    }
                    return response()->json(['success' => 1, 'message' => $this->module . ' created successfully.']);
                }
            }
        } else {

            $id = $request->id;
            if ($id) {
                return $this->update_data($request);
            } else {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'title'          => 'required',
                        'sub_title'   => 'required',
                    ]
                );
                if ($validator->fails()) {
                    return $validator->validate();
                } else {
                    $id = 0;
                    $obj = $this->modal::firstOrNew(['id' => $id]);
                    $obj->title = $request->title;
                    $obj->sub_title = $request->sub_title;
                    $obj->for_passport = $request->for_passport;
                    $obj->status = $request->status;
                    $obj->is_veg = $request->is_veg;
                    $obj->file_id = $request->file_id;
                    $obj->badge_file = $request->file_id_2;
                    $obj->stock = 1;
                    $obj->save();
                    return response()->json(['success' => 1, 'message' => $this->module . ' created successfully.']);
                }
            }
        }
    }


    public function edit($id)
    {
        $info = $this->modal::find($id);
        $places = Place::get();
        $locations = Location::get();
        $categories = Category::get();
        $hops = Hop::get();
        $malts = Malt::get();
        $ptypes = Ptype::get();

        $qry = Attribute::select('attributes.id', 'attributes.name', 'attributes.status');
        $qry->groupBy('attributes.id');
        $qry->groupBy('attributes.name');
        $qry->groupBy('attributes.status');
        $qry->selectRaw('GROUP_CONCAT(attribute_options.option_name) as options');
        $qry->selectRaw('GROUP_CONCAT(attribute_options.id) as option_ids');

        $qry->leftJoin('attribute_options', 'attribute_options.attr_id', '=', 'attributes.id');
        $qry->where('attributes.is_delete', 0);
        $qry->where('attribute_options.is_delete', 0);

        $qry->orderBy('attributes.id', 'ASC');

        $result = $qry->get();

        $attr_arr = $result->toArray();

        $attr_json = json_encode(array('data' => $attr_arr));

        $meta_arr = ProductMeta::select('*')->where('product_id', '=', $id)->get()->toArray();
        /*dd($qry);*/

        $result = array();
        if (is_array($meta_arr) && !empty($meta_arr)) {
            $attribute_id = $meta_arr[0]['attribute_id'];
            foreach ($meta_arr as $key => $value) {
                $result[$key]['attribute_id'] = $attribute_id;
                $result[$key]['option_id'] = $value['option_id'];
                $option_name  = array_values(AttributeOption::select('option_name')->where(['id' => $value['option_id']])->first()->toArray());
                $result[$key]['option_name'] = $option_name[0];
                $result[$key]['regular_price'] = $value['regular_price'];
                $result[$key]['tax'] = $value['tax'];
            }
        }


        //$result = $qry->get();
        $meta = json_encode(array('data' => $result));

        //var_dump($meta);

        // echo '<pre>info - '; print_r($info); die;
        return view('admin.' . $this->module . '.edit', [
            'info' => $info,
            'route' => $this->route,
            'module' => $this->module,
            'categories' => $categories,
            'hops' => $hops,
            'malts' => $malts,
            'ptypes' => $ptypes,
            'places' => $places,
            'locations' => $locations,
            'attributes' => $attr_json,
            'meta' => $meta,
            //'is_product_attr' => $info->is_product_attr,
        ]);
    }

    public function update_data(Request $request)
    {
        // echo "<pre>";print_R($request->all());die;
        if ($request->for_passport == 0) {

            $is_product_attr = (int) $request->is_product_attr;
            if ($is_product_attr > 0) {
            } else {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'price' => 'required',
                        'tax' => 'required',
                        'total_price' => 'required',
                    ]
                );
                if ($validator->fails()) {
                    return $validator->validate();
                }
            }

            $hops = $malt = '';
            if ($request->ptype == 1) {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'title'          => 'required',
                        'short_description'   => 'required',
                        'description'   => 'required',
                        'file_id'        => 'required',
                        'file_id_2'        => 'required',
                        'category' => 'required',
                        'place' => 'required',
                        'is_veg' => 'required',
                    ],
                    [
                        'file_id.required' => 'Product Image is required!',
                        'file_id_2.required' => 'Badge Image is required!',
                    ]
                );
                if ($request->hops) {
                    $hops = implode(',', $request->hops);
                }

                if ($request->malt) {
                    $malt = implode(',', $request->malt);
                }
            } else {
                $validator = Validator::make(
                    $request->all(),
                    [
                        'title'          => 'required',
                        'short_description'   => 'required',
                        'description'   => 'required',
                        'file_id'        => 'required',
                        'category' => 'required',
                        'place' => 'required',
                        'is_veg' => 'required',
                    ]
                );
            }

            if ($validator->fails()) {
                return $validator->validate();
            } else {

                $place_loc = Place::where('id', $request->place)->first();

                $obj = $this->modal::firstOrNew(['id' => $request->id]);
                $obj->title = $request->title;
                $obj->sub_title = $request->sub_title;
                $obj->short_description = $request->short_description;
                $obj->description = $request->description;
                $obj->category = $request->category;
                $obj->sub_category = $request->sub_category;
                $obj->file_id = $request->file_id;
                $obj->badge_file = $request->file_id_2;
                $obj->price = $request->price;
                $obj->tax = $request->tax;
                $obj->total_price = $request->total_price;
                $obj->is_veg = $request->is_veg;
                $obj->hops = $hops;
                $obj->malt = $malt;
                $obj->quantity = $request->quantity;
                $obj->percentage = $request->percentage;
                $obj->color = $request->color;
                $obj->orignal_gravity = $request->orignal_gravity;
                $obj->style = $request->style;
                $obj->status = $request->status;
                $obj->type = $request->ptype;
                $obj->place = $request->place;
                $obj->location = $place_loc->location;
                $obj->stock = $request->stock;
                $obj->for_passport = $request->for_passport;

                //$is_product_attr = $request->is_product_attr;
                if ($is_product_attr > 0) {
                    $obj->price = $request->attr_regular_price[0];
                    $obj->tax = $request->attr_tax_price[0];
                    $obj->total_price = $request->attr_total_price[0];
                    $obj->is_product_attr = 1;
                    $obj->attribute_id = $request['attributes'];
                    $obj->option_id = $request->attr_options_id[0];
                } else {
                    $obj->price = $request->price;
                    $obj->tax = $request->tax;
                    $obj->total_price = $request->total_price;
                    $obj->is_product_attr = 0;
                    $obj->attribute_id = 0;
                    $obj->option_id = 0;
                }

                $obj->save();

                $qry = ProductMeta::select('*')->where('product_id', '=', $obj->id);
                /*dd($qry);*/

                $result = $qry->get();
                $atts = $result->toArray();
                foreach ($atts as $attr) {
                    $meta = ProductMeta::find($attr['id']);
                    $meta->delete();
                }

                if ($is_product_attr > 0) {

                    for ($i = 0; $i < count($request->attr_options_id); $i++) {
                        $obj2 = ProductMeta::firstOrNew(
                            [
                                'product_id' => $obj->id,
                                'option_id' => $request->attr_options_id[$i]
                            ]
                        );
                        $obj2->attribute_id = $request['attributes'];
                        $obj2->regular_price = $request->attr_regular_price[$i];
                        $obj2->tax = $request->attr_tax_price[$i];
                        $obj2->created_at = date('Y-m-d h:i A', time());
                        $obj2->updated_at = date('Y-m-d h:i A', time());
                        $obj2->save();
                    }
                }

                return response()->json(['success' => 1, 'message' => $this->module . ' updated successfully.']);
            }
        } else {

            $validator = Validator::make(
                $request->all(),
                [
                    'title'          => 'required',
                    'sub_title'   => 'required',
                ]
            );
            if ($validator->fails()) {
                return $validator->validate();
            } else {

                $places = $request->place;
                $id =  $request->id;
                $obj = $this->modal::firstOrNew(['id' => $id]);
                $obj->title = $request->title;
                $obj->sub_title = $request->sub_title;
                $obj->status = $request->status;
                $obj->is_veg = $request->is_veg;
                $obj->file_id = $request->file_id;
                $obj->badge_file = $request->file_id_2;
                $obj->stock = 1;
                $obj->save();

                $obj = PassportFreeItem::firstOrNew(['product_id' => $id]);
                $obj->status = $request->status;
                $obj->save();
            }
            return response()->json(['success' => 1, 'message' => $this->module . ' updated successfully.']);
        }
    }


    public function destroy($id)
    {
        $qry = ProductMeta::select('*')->where('product_id', '=', $id);
        /*dd($qry);*/

        $result = $qry->get();
        $atts = $result->toArray();
        foreach ($atts as $attr) {
            $meta = ProductMeta::find($attr['id']);
            $meta->delete();
        }

        $user = $this->modal::find($id);
        $user->delete();
        return response()->json(['success' => 1, 'message' => $this->module . ' delete successfully.']);
    }


    public function upload(Request $request)
    { 
 
        return uploadImage($request);
    }

    public function product_set_location(Request $request)
    {

        $places = Place::where('location', $request->location_id)->get();

        // echo '<pre>location - '; print_r($location); die;
        if (isset($request->type) && $request->type == 'edit') {
            $output = '<option value="" >Select</option>';
            if (!empty($places->toArray())) {
                foreach ($places as $place) {
                    if ($request->place_id == $place->id) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $output .= '<option value="' . $place->id . '" ' . $selected . '>' . ucwords($place->name) . '</option>';
                }
            } else {
                $output .= '<option value="">No place found on selected location.</option>';
            }
            return response()->json(['status' => 1, 'opt' => $output]);
        } else {
            $output = '<option value="" >Select</option>';
            if (!empty($places->toArray())) {
                foreach ($places as $place) {
                    $output .= '<option value="' . $place->id . '">' . ucwords($place->name) . '</option>';
                }
            } else {
                $output .= '<option value="">No place found on selected location.</option>';
            }
            return response()->json(['status' => 1, 'opt' => $output]);
        }
    }


    public function product_duplicate(Request $request)
    {

        $product = Product::where('id', $request->id)->first();





        if ($product->for_passport == 0) {
            $data = array(
                'title' => $product->title,
                'sub_title' => $product->sub_title,
                'short_description' => $product->short_description,
                'description' => $product->description,
                'category' => $product->category,
                'sub_category' => $product->sub_category,
                'file_id' => $product->file_id,
                'badge_file' => $product->badge_file,
                'price' => $product->price,
                'tax' => $product->tax,
                'total_price' => $product->total_price,
                'hops' =>  $product->hops,
                'malt' =>  $product->malt,
                'quantity' => $product->quantity,
                'percentage' => $product->percentage,
                'color' => $product->color,
                'orignal_gravity' => $product->orignal_gravity,
                'style' => $product->style,
                'status' => $product->status,
                'type' => $product->type,
                'place' => $product->place,
                'location' => $product->location,
                'stock' => $product->stock,
                'is_product_attr' => $product->is_product_attr,
                'attribute_id' => $product->attribute_id,
                'option_id' => $product->option_id,
                'is_home' => $product->is_home,
                'for_passport' => $product->for_passport,
            );
        } else {
            $data = array(
                'title' => $product->title,
                'sub_title' => $product->sub_title,
                'status' => $product->status,
                'is_veg' => $product->is_veg,
                'file_id' => $product->file_id,
                'badge_file' => $product->badge_file,
                'stock' => $product->stock,
                'for_passport' => $product->for_passport,
            );
        }

        $data = Product::create($data)->id;






        $getProductMetas = ProductMeta::where('product_id', $request->id)->get();
        if (!empty($getProductMetas)) {
            foreach ($getProductMetas as $getProductMeta) {
                $obj2 = ProductMeta::firstOrNew(
                    [
                        'product_id' => $last_id,
                        'option_id' => $getProductMeta->option_id
                    ]
                );
                $obj2->attribute_id = $getProductMeta->attribute_id;
                $obj2->regular_price = $getProductMeta->regular_price;
                $obj2->tax = $getProductMeta->tax;
                $obj2->created_at = date('Y-m-d h:i A', time());
                $obj2->updated_at = date('Y-m-d h:i A', time());
                $obj2->save();
            }
        }
        // echo "<pre>";
        // print_r($obj2);
        // die;

        return response()->json(['status' => 1, 'msg' => 'Duplicate Product Succesfully']);
    }

    public function freeProduct()
    {
        $this->page->title = $this->module . 's List';
        return view('admin.' . $this->module . '.freeProductList', ['page' => $this->page, 'route' => $this->route, 'module' => $this->module]);
    }


    public function freeProductList(Request $request)
    {

        ## Read value
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value


        $totalRecords = $this->modal::where('for_passport', 1)->count();

        $totalRecordwithFilter = $totalRecords;

        $qry = $this->modal::select('products.*', 'locations.name')->where('for_passport', 1)->offset($row)->take($rowperpage);

        if ($searchValue) {
            $qry->where(function ($query) use ($searchValue) {
                $query->where('title', 'like', '%' . $searchValue . '%')
                    ->orWhere('sub_title', 'like', '%' . $searchValue . '%')
                    ->orWhere('locations.name', 'like', '%' . $searchValue . '%');
            });
        }

        $qry->leftJoin('locations', 'locations.id', '=', 'products.location');
        $qry->orderBy('id', 'DESC');

        $result = $qry->get();
        // echo '<pre>result - '; print_r($result->toArray()); die;

        $data = array();
        $i = 1;
        foreach ($result as $row) {

            $status_url = $this->route->freeProductstatus;
            if ($row->status == 1) {
                $status = '<div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="switch2" checked="" onchange=status_change("' . $status_url . '",this,' . $row->id . ');>
  <label class="custom-control-label" for="switch2"></label>
</div>';
            } else {
                $status = '<div class="custom-control custom-switch">
  <input type="checkbox" class="custom-control-input" id="switch2" onchange=status_change("' . $status_url . '",this,' . $row->id . ');>
  <label class="custom-control-label" for="switch2"></label>
</div>';
            }
            $action = '';
            $edit_url = $this->route->edit;
            $destroy_url = $this->route->destroy;
            $action .= '<a href="#!" onclick=productDuplicate(this,' . $row->id . ');><i class="fa fa-copy"></i></a>';
            $action .= '&nbsp;&nbsp;<a href="#!" onclick=edit_row("' . $edit_url . '",' . $row->id . ');><i class="fa fa-edit"></i></a>';
            $action .= '&nbsp;&nbsp;<a href="#!" class="text-danger" onclick=delete_row("' . $destroy_url . '",' . $row->id . ')><i class="text-danger fa fa-trash"></i></a>';

            $file = '<img src="' . asset('images/no_image.jpg') . '"  class="img-thumbnail " alt="" width="50" height="50">';
            if ($row->FileId) {
                $file = '<img src="' . asset($row->FileId->file) . '"  class="img-thumbnail " alt="" width="50" height="50">';
            }

            if (!empty($row->category)) {
                $cat = $row->Category->name;
            } else {
                $cat = '';
            }

            if (!empty($row->sub_category)) {
                $sub_cat = $row->SubCategory->name;
            } else {
                $sub_cat = '';
            }

            // echo "<pre>";print_r($row->Place->name);die;

            $data[] = array(
                "sno" => $i,
                "title" => $file . ' ' . $row->title,
                "sub_title" => $row->sub_title,
                "status" => $status,
                "created_at" => date('Y-m-d h:i A', strtotime($row->created_at)),
                "action" => $action,
            );

            $i++;
        }


        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }
    public function createfreeProduct()
    {
        $categories = Category::get();
        $locations = Location::get();
        $places = Place::get();
        $hops = Hop::get();
        $malts = Malt::get();
        $ptypes = Ptype::get();

        $qry = Attribute::select('attributes.id', 'attributes.name', 'attributes.status');
        $qry->groupBy('attributes.id');
        $qry->groupBy('attributes.name');
        $qry->groupBy('attributes.status');
        $qry->selectRaw('GROUP_CONCAT(attribute_options.option_name) as options');
        $qry->selectRaw('GROUP_CONCAT(attribute_options.id) as option_ids');

        $qry->leftJoin('attribute_options', 'attribute_options.attr_id', '=', 'attributes.id');
        $qry->where('attributes.is_delete', 0);
        $qry->where('attribute_options.is_delete', 0);

        $qry->orderBy('attributes.id', 'ASC');

        $result = $qry->get();

        $attr_arr = $result->toArray();

        $attr_json = json_encode(array('data' => $attr_arr));

        //echo '<pre>result - '; print_r($attr_json); die;

        return view('admin.' . $this->module . '.addfreeProduct', [
            'route' => $this->route,
            'module' => $this->module,
            'categories' => $categories,
            'hops' => $hops,
            'malts' => $malts,
            'ptypes' => $ptypes,
            'places' => $places,
            'locations' => $locations,
            'attributes' => $attr_json,
        ]);
    }
    public function status(Request $request)
    {
        $status = $this->modal::find($request->id);
        $status->status = $request->status;
        $status->save();
        return response()->json(['success' => 1]);
    }
}
