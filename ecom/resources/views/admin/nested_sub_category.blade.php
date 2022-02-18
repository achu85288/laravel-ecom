@extends('admin/layout')
@section('title')
Nested SubCategory
@endsection
@section('header')
Nested SubCategory
@endsection
@section('nested_sub_category_select','active')
@section('main')
<div class="text-right">
    <a href="{{url('admin/NestedSubCategory/Manage')}}"><button type="button" class="btn bg-purple btn-flat margin">Add Data</button>
    </a>
 </div>

<div class="box">
    @if(session('success'))
    <x-alert type="success" :msg="session('success')"/>
 @endif
    <div class="box-header">
      <h3 class="box-title">Nested SubCategory</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body flow">
      
      <table id="example" class="table table-bordered table-responsive table-hover">
        <thead>
            <tr>
               <th>Sr No.</th>
               <th>Name</th>    
               <th>Category</th>
               <th>Sub Category</th>                                                        
               <th>Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody> 
             @foreach ($data as $item)
             <tr>
               <td>{{$item->id}}</td>
               <td>{{$item->nested_sub_category_name}}</td>
               <td>
                  @php 
                  foreach($category as $cat){ 
                     if($cat->id == $item->category_id){
                        echo $cat->category_name;
                     }
                  }
                  @endphp
                  
               </td>
               <td>
                 @php 
                 foreach($sub_category as $sub_cat){ 
                    if($sub_cat->id == $item->sub_category_id){
                       echo $sub_cat->sub_category_name;
                    }
                 }
                 @endphp
                 
              </td>
               
               
               <td>
                  @if($item->status ==1)
                  <a href="{{url('admin/NestedSubCategory/0/'.$item->id)}}" class="btn btn-sm btn-success">Active</a>
                  @else
                  <a href="{{url('admin/NestedSubCategory/1/'.$item->id)}}" class="btn btn-sm btn-danger">Deactive</a>
                  @endif
                 
               </td>
               <td>
                  <a href="{{url('admin/NestedSubCategory/Manage/'.$item->id)}}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                  <a href="{{url('admin/NestedSubCategory/Delete/'.$item->id)}}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
               </td>
             </tr>
             @endforeach
         </tbody>

      </table>
    </div>
    <!-- /.box-body -->
  </div>
@endsection