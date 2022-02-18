@extends('admin/layout')
@section('title')
SubCategory
@endsection
@section('header')
SubCategory
@endsection
@section('sub_category_select','active')
@section('main')
<div class="text-right">
    <a href="{{url('admin/SubCategory/Manage')}}"><button type="button" class="btn bg-purple btn-flat margin">Add Data</button>
    </a>
 </div>

<div class="box">
    @if(session('success'))
    <x-alert type="success" :msg="session('success')"/>
 @endif
    <div class="box-header">
      <h3 class="box-title">Data Table With Full Features</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body flow">
      
      <table id="example" class="table table-bordered table-responsive table-hover">
        <thead>
            <tr>
               <th>Sr No.</th>                              
               <th>Name</th>   
               <th>Category</th>                           
               <th>Status</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody> 
             @foreach ($data as $item)
             <tr>
               <td>{{$item->id}}</td>
               <td>{{$item->sub_category_name}}</td>
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
                  @if($item->status ==1)
                  <a href="{{url('admin/SubCategory/0/'.$item->id)}}" class="btn btn-sm btn-success">Active</a>
                  @else
                  <a href="{{url('admin/SubCategory/1/'.$item->id)}}" class="btn btn-sm btn-danger">Deactive</a>
                  @endif
                 
               </td>
               <td>
                  <a href="{{url('admin/SubCategory/Manage/'.$item->id)}}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                  <a href="{{url('admin/SubCategory/Delete/'.$item->id)}}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
               </td>
             </tr>
             @endforeach
         </tbody>

      </table>
    </div>
    <!-- /.box-body -->
  </div>
@endsection