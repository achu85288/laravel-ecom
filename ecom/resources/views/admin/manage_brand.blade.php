@extends('admin/layout')
@section('title')
Brand
@endsection
@section('header')
Brand
@endsection
@section('brand_select','active')
@section('main')
@php
if(!empty($data)){
   foreach($data as $item){
      $brand_id = $item->id;
      $brand_name = $item->brand_name;
      $brand_image=$item->image;
   }            
}            
else{
   $brand_id =0;
   $brand_name = '';
   $brand_image='image_preview.png';
}
@endphp
<div class="text-left">
    <a href="{{url('admin/Brand/Manage')}}"><button type="button" class="btn bg-navy btn-flat margin">Back</button>
    </a>
 </div>
 <div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Brand</h3>
        @if(session('success'))
        <x-alert type="success" :msg="session('success')"/>
     @endif
    </div>
    <form method="post" action="{{route('brand.insert')}}" enctype="multipart/form-data">
        @csrf
    <div class="box-body">

        <div class="form-group row">
            <label for="brand_name" class="col-sm-2 col-form-label text-center">Name</label>
            <div class="col-sm-7">
               <input type="text" class="form-control" required="" id="brand_name" name="brand_name"  placeholder="Name" value={{$brand_name}}>
               <input type="hidden" name="brand_id" value="{{$brand_id}}">
               <span class="error_msg">
                @error('brand_name')
                {{$message}}
                @enderror
                </span>
            </div>
        </div>
         <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label text-center">Profile</label>
            <div class="col-sm-7">
               <input type="file"   class="form-control" id="picture2" name="image" onchange="previewFile(this);">
               <span class="error_msg">
                @error('image')
                {{$message}}
                @enderror
                </span>
            </div>
            
         </div>
         <div class="form-group row">
            <label for="banner" class="col-sm-2 col-form-label text-center">Profile:</label>
            <div class="col-sm-7">
               <img id="previewImg" src="{{asset('storage/media/'.$brand_image)}}" alt="Uploaded Image Preview Holder" width="200px" height="200px">
            </div>
         </div>
         <script>
            function previewFile(input){
                 var file = $("#picture2").get(0).files[0];
            
                 if(file){
                     var reader = new FileReader();
            
                     reader.onload = function(){
                         $("#previewImg").attr("src", reader.result);
                     }
            
                     reader.readAsDataURL(file);
                 }
             }
         </script>
         </div>
         <div class="box-footer">
            <center><a href="{{url('admin/Brand')}}" class="btn bg-orange btn-flat margin" >Close</a><input name="brand_add" value="Save" type="submit" class="btn bg-maroon btn-flat margin" id="Save"></center>
         </div>
    
    
</form>
    <!-- /.box-body -->
  </div>
 
  @endsection