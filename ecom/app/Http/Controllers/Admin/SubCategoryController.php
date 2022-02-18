<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 

use App\Models\Admin\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubCategoryController extends Controller
{
    public function index(){
        $model = SubCategory::all();
        $category = DB::table('categories')->where('status','1')->get();
        return view('admin.sub_category',['data'=>$model,'category'=>$category]);
    }
    
    public function manage_sub_category($id=''){
       
        if($id > 0 && $id !=''){
            $model =SubCategory::find($id)->get();
        }
        else{
            $model ='';
        }

        $category = DB::table('categories')->where('status','1')->get();

        return view('admin.manage_sub_category',['data'=>$model,'category'=>$category]);
    }
    public function insert(Request $request){
        
        $request->validate([ 
            'category_id'=>'required',
            'sub_category_name'=>'required'
        ]);
        $sub_category_name = $request->input('sub_category_name');
        $category_id = $request->input('category_id');
        $sub_category_id = $request->input('sub_category_id');
        
        if($sub_category_id > 0){
            $model=SubCategory::find($sub_category_id);
            $msg = 'Data Updated.';
        }
        else{
            $model = new SubCategory;
            $msg = 'Data Inserted.';
        }
       
        
        $model->sub_category_name=$sub_category_name;
        $model->category_id=$category_id;
        $model->save();

        $request->session()->flash('success',$msg);
        return redirect('admin/SubCategory');
    }
    public function delete(Request $request,$id){
        $model=SubCategory::find($id);
        $model->delete();
        $request->session()->flash('success','Data Removed.');
        return redirect('admin/SubCategory');

    }

    public function status(Request $request , $status ,$id){
        $model = SubCategory::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('success','Status Updated.');
        return redirect('admin/SubCategory');
    }
    
}
