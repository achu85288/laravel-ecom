<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function index(){
        $model = GeneralSetting::all();
        return view('admin.setting',['data'=>$model]);
    }
    public function manage_setting()
    {
        
    }
    
}
