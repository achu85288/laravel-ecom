<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller; 

use App\Models\Admin\ProductAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProductAttributeController extends Controller
{
    public function index($id=''){
       
        $model = ProductAttribute::all();
        $updt_model="";
        if($id > 0 && $id !=''){
            $updt_model = ProductAttribute::find($id);
        }
        $values = DB::table('product_attribute_values')->get();
        
        return view('admin.product_attribute',['data'=>$model,'values'=>$values,'updt_model'=>$updt_model]);
    }
 
    public function insert(Request $request){
        
        
        $request->validate([ 
            'product_attribute_name'=>'required|unique:product_attributes,product_attribute_name,'.$request->input('product_attribute_id')
        ]);
      
        $product_attribute_name = strtolower($request->input('product_attribute_name'));
        $product_attribute_id = $request->input('product_attribute_id');
        
        $clm_name = str_replace(' ','_',strtolower(trim($product_attribute_name)));

        if($product_attribute_id > 0){
            $model=ProductAttribute::find($product_attribute_id);
            
            $old_name = str_replace(' ','_',strtolower(trim( $model->product_attribute_name)));
            DB::statement("ALTER TABLE `product_varients` CHANGE `$old_name` `$clm_name`  INT(11)DEFAULT 0 NOT NULL");

            $msg = 'Data Updated.';
        }
        else{
            $model = new ProductAttribute;
            DB::statement("ALTER TABLE `product_varients` ADD `$clm_name` INT DEFAULT 0 NOT NULL AFTER `product_id`");
            $msg = 'Data Inserted.';
        }
        
        $model->product_attribute_name=$product_attribute_name;
        $model->save();

        $request->session()->flash('success',$msg);
        return redirect('admin/ProductAttribute');
    }
    public function delete(Request $request,$id){
        $model=ProductAttribute::find($id);
        
        $clm_name = str_replace(' ','_',strtolower(trim( $model->product_attribute_name)));
        DB::statement("ALTER TABLE `product_varients` DROP `$clm_name` ");

        $model->delete();
        $request->session()->flash('success','Data Removed.');
        return redirect('admin/ProductAttribute');

    }

    public function status(Request $request , $status ,$id){
        $model = ProductAttribute::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('success','Status Updated.');
        return redirect('admin/ProductAttribute');
    }
}
