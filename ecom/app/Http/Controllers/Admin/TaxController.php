<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 

use App\Models\Admin\tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index(){
        $model = Tax::all();
        return view('admin.tax',['data'=>$model]);
    }
    public function manage_tax($id=''){
       
        if($id > 0 && $id !=''){
            $model =Tax::find($id)->get();
        }
        else{
            $model ='';
        }
        return view('admin.manage_tax',['data'=>$model]);
    }
    public function insert(Request $request){
        
        if($request->input('tax_id') > 0){
            $image_validate="mimes:jpeg,jpg,png";
        }
        else{
            $image_validate="required|mimes:jpeg,jpg,png";
        }
        $request->validate([ 
            'tax_name'=>'required|unique:taxs,tax_name,'.$request->input('tax_id'), 
            'image'=>$image_validate
        ]);
      
        $tax_name = $request->input('tax_name');
        $tax_value = $request->input('tax_value');
        $tax_id = $request->input('tax_id');
        
        if($tax_id > 0){
            $model=Tax::find($tax_id);
            $msg = 'Data Updated.';
        }
        else{
            $model = new Tax;
            $msg = 'Data Inserted.';
        }
        
        $model->tax_name=$tax_name;$model->tax_value=$tax_value;
        $model->save();

        $request->session()->flash('success',$msg);
        return redirect('admin/Tax');
    }
    public function delete(Request $request,$id){
        $model=Tax::find($id);
        $model->delete();
        $request->session()->flash('success','Data Removed.');
        return redirect('admin/Tax');

    }

    public function status(Request $request , $status ,$id){
        $model = Tax::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('success','Status Updated.');
        return redirect('admin/Tax');
    }
}
