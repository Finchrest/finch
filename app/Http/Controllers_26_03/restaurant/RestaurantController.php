<?php

namespace App\Http\Controllers\restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
	protected $page;
 
    public function __construct(){
        $this->page = new \stdClass;
	}
	
    public function index()
    {
		$this->page->title = 'Dashboard';
        return view('restaurant.dashboard', ['page' => $this->page]);
    }
	
}
