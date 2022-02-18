<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 
use App\Models\Admin\ProductAttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProductAttributeValueController extends Controller
{
    public function index($id='',$pid=''){
      
            $updt_model =DB::table('product_attribute_values')->where('product_attribute_id',$id)->get();
            $values = DB::table('product_attributes')->where('id',$id)->get();
        
        
        
        return view('admin.product_attribute_value',['data'=>$updt_model,'updt_model'=>$values]);
    }
 
    public function insert(Request $request){
                
        $product_attribute_value_id =$request->input('product_attribute_value_id');
        $product_attribute_id =$request->input('product_attribute_name');
        $product_attribute_value = $request->input('product_attribute_value');

        $request->validate([ 
            'product_attribute_value'=>'required|unique:product_attribute_values,product_attribute_value,'.$request->input('product_attribute_id')
        ]);

        if($product_attribute_value_id > 0){
             $model=ProductAttributeValue::find($product_attribute_value_id);
             $msg = 'Data Updated.';
         }
        else{
            $model = new ProductAttributeValue;
            $msg = 'Data Inserted.';
        }
        
        $model->product_attribute_id=$product_attribute_id;
        $model->product_attribute_value=$product_attribute_value;
        $model->save();

        $request->session()->flash('success',$msg);
        return redirect()->back();
    }
    public function delete(Request $request,$id){
        $model=ProductAttributeValue::find($id);
        $model->delete();
        $request->session()->flash('success','Data Removed.');
        return redirect()->back();

    }

    public function status(Request $request , $status ,$id){
        $model = ProductAttributeValue::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('success','Status Updated.');
        return redirect()->back();
    }
}
