<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
	protected $page;
 
    public function __construct(){
        $this->page = new \stdClass;
	}
	
    public function index()
    {
		$this->page->title = 'Dashboard';
        return view('admin.dashboard', ['page' => $this->page]);
    }
	
}
