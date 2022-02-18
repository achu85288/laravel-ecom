<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 

use App\Models\Admin\size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index(){
        $model = Size::all();
        return view('admin.size',['data'=>$model]);
    }
    public function manage_size($id=''){
        
        if($id > 0 && $id !=''){
            $model =Size::find($id)->get();
        }
        else{
            $model ='';
        }
        return view('admin.manage_size',['data'=>$model]);
    }
    public function insert(Request $request){
        
        
        $request->validate([ 
            'size_name'=>'required|unique:sizes,size_name,'.$request->input('size_id')
        ]);
      
        $size_name = $request->input('size_name');
        $size_id = $request->input('size_id');
        
        if($size_id > 0){
            $model=Size::find($size_id);
            $msg = 'Data Updated.';
        }
        else{
            $model = new Size;
            $msg = 'Data Inserted.';
        }
        
        $model->size_name=$size_name;
        $model->save();

        $request->session()->flash('success',$msg);
        return redirect('admin/Size');
    }
    public function delete(Request $request,$id){
        $model=Size::find($id);
        $model->delete();
        $request->session()->flash('success','Data Removed.');
        return redirect('admin/Size');

    }

    public function status(Request $request , $status ,$id){
        $model = Size::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('success','Status Updated.');
        return redirect('admin/Size');
    }
}
