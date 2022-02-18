<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; 

use App\Models\Admin\modal;
use Illuminate\Http\Request;

class ModalController extends Controller
{
    public function index(){
        $model = Modal::all();
        return view('admin.modal',['data'=>$model]);
    }
    public function manage_modal($id=''){
       
        if($id > 0 && $id !=''){
            $model =Modal::find($id)->get();
        }
        else{
            $model ='';
        }
        return view('admin.manage_modal',['data'=>$model]);
    }
    public function insert(Request $request){
        
       
        $request->validate([ 
            'modal_name'=>'required|unique:modals,modal_name,'.$request->input('modal_id')
        ]);
      
        $modal_name = $request->input('modal_name');
        $modal_id = $request->input('modal_id');
        
        if($modal_id > 0){
            $model=Modal::find($modal_id);
            $msg = 'Data Updated.';
        }
        else{
            $model = new Modal;
            $msg = 'Data Inserted.';
        }
        
        $model->modal_name=$modal_name;
        $model->save();

        $request->session()->flash('success',$msg);
        return redirect('admin/Modal');
    }
    public function delete(Request $request,$id){
        $model=Modal::find($id);
        $model->delete();
        $request->session()->flash('success','Data Removed.');
        return redirect('admin/Modal');

    }

    public function status(Request $request , $status ,$id){
        $model = Modal::find($id);
        $model->status = $status;
        $model->save();
        $request->session()->flash('success','Status Updated.');
        return redirect('admin/Modal');
    }
}
