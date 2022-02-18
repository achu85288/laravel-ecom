<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller; 

use App\Models\Admin\Category;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        return view('front.index');
    }
   
    
}
