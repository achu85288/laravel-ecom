@extends('admin/layout')
@section('title')
Color
@endsection
@section('header')
Color
@endsection
@section('color_select','active')
@section('main')
@php
if(!empty($data)){
   foreach($data as $item){
      $color_id = $item->id;
      $color_name = $item->color_name;
      $color_code = $item->color_code;
   }            
}            
else{
   $color_id =0;
   $color_name = $color_code='';
}
@endphp
<div class="text-left">
    <a href="{{url('admin/Color/Manage')}}"><button type="button" class="btn bg-navy btn-flat margin">Back</button>
    </a>
 </div>
 <div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Color</h3>
        @if(session('success'))
        <x-alert type="success" :msg="session('success')"/>
     @endif
    </div>
    <form method="post" action="{{route('color.insert')}}" enctype="multipart/form-data">
        @csrf
    <div class="box-body">

        <div class="form-group row">
            <label for="color_name" class="col-sm-2 col-form-label text-center">Name</label>
            <div class="col-sm-7">
               <input type="text" class="form-control" required="" id="color_name" name="color_name"  placeholder="Name" value={{$color_name}}>
               <input type="hidden" name="color_id" value="{{$color_id}}">
               <span class="error_msg">
                @error('color_name')
                {{$message}}
                @enderror
                </span>
            </div>
        </div>
        <div class="form-group row">
            <label for="color_code" class="col-sm-2 col-form-label text-center">Code</label>
            <div class="col-sm-7">
               <input type="color" class="form-control" required="" id="color_code" name="color_code"  placeholder="Name" value={{$color_code}}>
               <input type="hidden" name="color_id" value="{{$color_id}}">
               <span class="error_msg">
                @error('color_code')
                {{$message}}
                @enderror
                </span>
            </div>
        </div>
      
         </div>
         <div class="box-footer">
            <center><a href="{{url('admin/Color')}}" class="btn bg-orange btn-flat margin" >Close</a><input name="color_add" value="Save" type="submit" class="btn bg-maroon btn-flat margin" id="Save"></center>
         </div>
    
    
</form>
    <!-- /.box-body -->
  </div>
 
  @endsection