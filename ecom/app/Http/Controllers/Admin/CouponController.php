<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 

use App\Models\Admin\coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index(){
        $model = Coupon::all();
        return view('admin.coupon',['data'=>$model]);
    }
    public function manage_coupon($id=''){
       
        if($id > 0 && $id !=''){
            $model =Coupon::find($id)->get();
        }
        else{
            $model ='';
        }
        return view('admin.manage_coupon',['data'=>$model]);
    }
    public function insert(Request $request){
        $request->validate([ 
            'title'=>'required',
            'value'=>'required', 
            'code'=>'required|unique:coupons,code,'.$request->input('id') 
        ]);
        $title = $request->input('title');
        $value = $request->input('value');
        $code = $request->input('code');
        $id = $request->input('id');
        
        if($id > 0){
            $model=Coupon::find($id);
            $msg = 'Data Updated.';
        }
        else{
            $model = new Coupon;
            $msg = 'Data Inserted.';
        }
        
        $model->title=$title;
        $model->value=$value;$model->code=$code;
        $model->save();

        $request->session()->flash('success',$msg);
        return redirect('admin/Coupon');
    }
    public function delete(Request $request,$id){
        $model=Coupon::find($id);
        $model->delete();
        $request->session()->flash('success','Data Removed.');
        return redirect('admin/Coupon');

    }
    public function status(Request $request , $status ,$id){
        $model = Coupon::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('success','Status Updated.');
        return redirect('admin/Coupon');
    }
}
