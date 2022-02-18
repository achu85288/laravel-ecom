<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 

use App\Models\Admin\NestedSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class NestedSubCategoryController extends Controller
{
    public function index(){
        $model = NestedSubCategory::all(); 
        $category = DB::table('categories')->where('status','1')->get();
        $sub_category = DB::table('sub_categories')->where('status','1')->get();
        return view('admin.nested_sub_category',['data'=>$model,'category'=>$category,'sub_category'=>$sub_category]);
    }
    public function manage_nested_sub_category($id=''){
       
        if($id > 0 && $id !=''){
            $model =NestedSubCategory::find($id)->get();
            $sub_category = DB::table('sub_categories')->where('status','1')->get();
        }
        else{
            $model =$sub_category='';
        }
        $category = DB::table('categories')->where('status','1')->get();
        
        return view('admin.manage_nested_sub_category',['data'=>$model,'category'=>$category,'sub_category'=>$sub_category]);
    }
    public function insert(Request $request){
        
        $request->validate([ 
            'category_id'=>'required',
            'sub_category_id'=>'required',
            'nested_sub_category_name'=>'required'
        ]);
 
        $nested_sub_category_name = $request->input('nested_sub_category_name');
        $sub_category_id = $request->input('sub_category_id');
        $category_id = $request->input('category_id');
        $nested_sub_category_id = $request->input('nested_sub_category_id');
        
        if($nested_sub_category_id > 0){
            $model=NestedSubCategory::find($nested_sub_category_id);
            $msg = 'Data Updated.';
        }
        else{
            $model = new NestedSubCategory;
            $msg = 'Data Inserted.';
        }
                
        $model->nested_sub_category_name=$nested_sub_category_name;
        $model->category_id=$category_id;
        $model->sub_category_id=$sub_category_id;
        $model->save();
        $request->session()->flash('success',$msg);
        return redirect('admin/NestedSubCategory');
    }
    public function delete(Request $request,$id){
        $model=NestedSubCategory::find($id);
        $model->delete();
        $request->session()->flash('success','Data Removed.');
        return redirect('admin/NestedSubCategory');

    }

    public function status(Request $request , $status ,$id){
        $model = NestedSubCategory::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('success','Status Updated.');
        return redirect('admin/NestedSubCategory');
    }
    
}
