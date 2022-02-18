@extends('admin/layout')
@section('title')
Tax
@endsection
@section('header')
Tax
@endsection
@section('tax_select','active')
@section('main')
@php
if(!empty($data)){
   foreach($data as $item){
      $tax_id = $item->id;
      $tax_name = $item->tax_name;
      $tax_value = $item->tax_value;
   }            
}            
else{
   $tax_id =0;
   $tax_name = $tax_value='';
}
@endphp
<div class="text-left">
    <a href="{{url('admin/Tax/Manage')}}"><button type="button" class="btn bg-navy btn-flat margin">Back</button>
    </a>
 </div>
 <div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Tax</h3>
        @if(session('success'))
        <x-alert type="success" :msg="session('success')"/>
     @endif
    </div>
    <form method="post" action="{{route('tax.insert')}}" enctype="multipart/form-data">
        @csrf
    <div class="box-body">

        <div class="form-group row">
            <label for="tax_name" class="col-sm-2 col-form-label text-center">Name</label>
            <div class="col-sm-7">
               <input type="text" class="form-control" required="" id="tax_name" name="tax_name"  placeholder="Name" value={{$tax_name}}>
               <input type="hidden" name="tax_id" value="{{$tax_id}}">
               <span class="error_msg">
                @error('tax_name')
                {{$message}}
                @enderror
                </span>
            </div>
        </div>
        <div class="form-group row">
            <label for="tax_value" class="col-sm-2 col-form-label text-center">Value</label>
            <div class="col-sm-7">
               <input type="tax" class="form-control" required="" id="tax_value" name="tax_value"  placeholder="Name" value={{$tax_value}}>
               <input type="hidden" name="tax_id" value="{{$tax_id}}">
               <span class="error_msg">
                @error('tax_value')
                {{$message}}
                @enderror
                </span>
            </div>
        </div>
      
         </div>
         <div class="box-footer">
            <center><a href="{{url('admin/Tax')}}" class="btn bg-orange btn-flat margin" >Close</a><input name="tax_add" value="Save" type="submit" class="btn bg-maroon btn-flat margin" id="Save"></center>
         </div>
    
    
</form>
    <!-- /.box-body -->
  </div>
 
  @endsection