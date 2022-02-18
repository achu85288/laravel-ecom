<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 

use App\Models\Admin\color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index(){
        $model = Color::all();
        return view('admin.color',['data'=>$model]);
    }
    public function manage_color($id=''){
       
        if($id > 0 && $id !=''){
            $model =Color::find($id)->get();
        }
        else{
            $model ='';
        }
        return view('admin.manage_color',['data'=>$model]);
    }
    public function insert(Request $request){
        
        $request->validate([ 
            'color_name'=>'required|unique:colors,color_name,'.$request->input('color_id')
        ]);
      
        $color_name = $request->input('color_name');
        $color_code = $request->input('color_code');
        $color_id = $request->input('color_id');
        
        if($color_id > 0){
            $model=Color::find($color_id);
            $msg = 'Data Updated.';
        }
        else{
            $model = new Color;
            $msg = 'Data Inserted.';
        }
        
        $model->color_name=$color_name;$model->color_code=$color_code;
        $model->save();

        $request->session()->flash('success',$msg);
        return redirect('admin/Color');
    }
    public function delete(Request $request,$id){
        $model=Color::find($id);
        $model->delete();
        $request->session()->flash('success','Data Removed.');
        return redirect('admin/Color');

    }

    public function status(Request $request , $status ,$id){
        $model = Color::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('success','Status Updated.');
        return redirect('admin/Color');
    }
}
