@extends('admin/layout')
@section('title')
SubCategory
@endsection
@section('header')
SubCategory
@endsection
@section('sub_category_select','active')
@section('main')
@php
if(!empty($data)){
   foreach($data as $item){
      $sub_category_id = $item->id;
      $sub_category_name = $item->sub_category_name;
      $category_id=$item->category_id;
      
   }            
}            
else{
   $sub_category_id =0;
   $sub_category_name = $category_id='';
   
}
@endphp
<div class="text-left">
    <a href="{{url('admin/SubCategory/Manage')}}"><button type="button" class="btn bg-navy btn-flat margin">Back</button>
    </a>
 </div>
 <div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">SubCategory</h3>
        @if(session('success'))
        <x-alert type="success" :msg="session('success')"/>
     @endif
    </div>
    <form method="post" action="{{route('sub_category.insert')}}" enctype="multipart/form-data">
        @csrf
    <div class="box-body">

        <div class="form-group row">
            <label for="category_name" class="col-sm-2 col-form-label text-center">Category</label>
            <div class="col-sm-8">
               <select class="form-control"  id="category_id" name="category_id" >
                  <option>-Select-</option>
                  @foreach($category as $cat){                                       
                  <option value={{$cat->id}}
                    @if ($category_id == $cat->id)
                        {{"selected = selected"}}
                    @endif>{{$cat->category_name}}</option>
                  }
                  @endforeach
               </select>
               <span class="error_msg">
                @error('category_id')
                {{$message}}
                @enderror
               </span>
            </div>
         </div>
         
    <div class="form-group row">
       <label for="sub_category_name" class="col-sm-2 col-form-label text-center">Name</label>
       <div class="col-sm-8">
          <input type="text" class="form-control" required="" id="sub_category_name" name="sub_category_name"  placeholder="Name" value={{$sub_category_name}}>
          <span class="error_msg">
            @error('sub_category_name')
            {{$message}}
            @enderror
           </span>
        </div>
       <input type="hidden" name="sub_category_id" value="{{$sub_category_id}}">
    </div>
    
    
         </div>
         <div class="box-footer">
            <center><a href="{{url('admin/SubCategory')}}" class="btn bg-orange btn-flat margin" >Close</a><input name="sub_category_add" value="Save" type="submit" class="btn bg-maroon btn-flat margin" id="Save"></center>
         </div>
    
    
</form>
    <!-- /.box-body -->
  </div>
 
  @endsection