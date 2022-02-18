<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 

use App\Models\Admin\brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(){
        $model = Brand::all();
        return view('admin.brand',['data'=>$model]);
    }
    public function manage_brand($id=''){
       
        if($id > 0 && $id !=''){
            $model =Brand::find($id)->get();
        }
        else{
            $model ='';
        }
        return view('admin.manage_brand',['data'=>$model]);
    }
    public function insert(Request $request){
        
        if($request->input('brand_id') > 0){
            $image_validate="mimes:jpeg,jpg,png";
        }
        else{
            $image_validate="required|mimes:jpeg,jpg,png";
        }
        $request->validate([ 
            'brand_name'=>'required|unique:brands,brand_name,'.$request->input('brand_id'), 
            'image'=>$image_validate
        ]);
      
        $brand_name = $request->input('brand_name');
        $brand_id = $request->input('brand_id');
        
        if($brand_id > 0){
            $model=Brand::find($brand_id);
            $msg = 'Data Updated.';
        }
        else{
            $model = new Brand;
            $msg = 'Data Inserted.';
        }
        if($request->hasfile('image')){
            $image =$request->file('image');
            $ext = $image->extension();
            $image_name = date('YmdHis').'.'.$ext;
            $image->storeAs('/public/media/',$image_name);
            $model->image = $image_name;
        }
        $model->brand_name=$brand_name;
        $model->save();

        $request->session()->flash('success',$msg);
        return redirect('admin/Brand');
    }
    public function delete(Request $request,$id){
        $model=Brand::find($id);
        $model->delete();
        $request->session()->flash('success','Data Removed.');
        return redirect('admin/Brand');

    }

    public function status(Request $request , $status ,$id){
        $model = Brand::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('success','Status Updated.');
        return redirect('admin/Brand');
    }
}
