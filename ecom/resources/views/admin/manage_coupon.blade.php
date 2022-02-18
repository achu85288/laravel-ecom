@extends('admin/layout')
@section('title')
Coupon
@endsection
@section('header')
Coupon
@endsection
@section('coupon_select','active')
@section('main')
@php
if(!empty($data)){
   foreach($data as $item){
      $coupon_id = $item->id;
      $title = $item->title;
      $code=$item->code;
      $value=$item->value;
   }            
}            
else{
   $coupon_id =0;
   $title = $code=$value='';
}
@endphp
<div class="text-left">
    <a href="{{url('admin/Coupon/Manage')}}"><button type="button" class="btn bg-navy btn-flat margin">Back</button>
    </a>
 </div>
 <div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Coupon</h3>
        @if(session('success'))
        <x-alert type="success" :msg="session('success')"/>
     @endif
    </div>
    <form method="post" action="{{route('coupon.insert')}}" enctype="multipart/form-data">
        @csrf
    <div class="box-body">

      <div class="form-group row">
         <label for="title" class="col-sm-2 col-form-label text-center">Name</label>
         <div class="col-sm-8">
            <input type="text" class="form-control" required="" id="title" name="title"  placeholder="Name" value={{$title}}>
         </div>
         <input type="hidden" name="id" value="{{$coupon_id}}">
      </div>
      <span class="error_msg">
       @error('title')
       {{$message}}
       @enderror
      </span>
      <div class="form-group row">
         <label for="title" class="col-sm-2 col-form-label text-center">Code</label>
         <div class="col-sm-8">
            <input type="text" class="form-control" required="" id="code" name="code"  placeholder="Slug" value={{$code}} >
         <span class="error_msg">
          @error('code')
          {{$message}}
          @enderror
         </span>
         </div>
         
        
      </div>
      <div class="form-group row">
         <label for="title" class="col-sm-2 col-form-label text-center">Value</label>
         <div class="col-sm-8">
            <input type="text" class="form-control" required="" id="value" name="value"  placeholder="Value" value={{$value}} >
            <span class="error_msg">
               @error('value')
               {{$message}}
               @enderror
              </span>
         </div>
       
        
      </div>
         </div>
         <div class="box-footer">
            <center><a href="{{url('admin/Coupon')}}" class="btn bg-orange btn-flat margin" >Close</a><input name="coupon_add" value="Save" type="submit" class="btn bg-maroon btn-flat margin" id="Save"></center>
         </div>
    
    
</form>
    <!-- /.box-body -->
  </div>
 
  @endsection