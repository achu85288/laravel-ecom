<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 

use App\Models\Admin\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $model = Category::all();
        return view('admin.category',['data'=>$model]);
    }
    public function manage_category($id=''){
       
        if($id > 0 && $id !=''){
            $model =Category::find($id)->get();
        }
        else{
            $model ='';
        }
        return view('admin.manage_category',['data'=>$model]);
    }
    public function insert(Request $request){
        
        if($request->input('category_id') > 0){
            $image_validate="mimes:jpeg,jpg,png";
        }
        else{
            $image_validate="required|mimes:jpeg,jpg,png";
        }
        $request->validate([ 
            'category_name'=>'required',
            'category_slug'=>'required|unique:categories,category_slug,'.$request->input('category_id'), 
            'image'=>$image_validate
        ]);
        $category_name = $request->input('category_name');
        $category_slug = $request->input('category_slug');
        $category_id = $request->input('category_id');
        
        if($category_id > 0){
            $model=Category::find($category_id);
            $msg = 'Data Updated.';
        }
        else{
            $model = new Category;
            $msg = 'Data Inserted.';
        }
        if($request->hasfile('image')){
            $image =$request->file('image');
            $ext = $image->extension();
            $image_name = date('YmdHis').'.'.$ext;
            $image->storeAs('/public/media/category/',$image_name);
            $model->image = $image_name;
        }
        $model->category_name=$category_name;
        $model->category_slug=$category_slug;
        $model->save();

        $request->session()->flash('success',$msg);
        return redirect('admin/Category');
    }
    public function delete(Request $request,$id){
        $model=Category::find($id);
        $model->delete();
        $request->session()->flash('success','Data Removed.');
        return redirect('admin/Category');

    }

    public function status(Request $request , $status ,$id){
        $model = Category::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('success','Status Updated.');
        return redirect('admin/Category');
    }
    
}
