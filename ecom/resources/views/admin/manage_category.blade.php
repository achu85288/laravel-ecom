@extends('admin/layout')
@section('title')
Category
@endsection
@section('header')
Category
@endsection
@section('category_select','active')
@section('main')
@php
if(!empty($data)){
   foreach($data as $item){
      $category_id = $item->id;
      $category_name = $item->category_name;
      $category_slug=$item->category_slug;
      $category_image=$item->image;
   }            
}            
else{
   $category_id =0;
   $category_name = $category_slug='';
   $category_image='image_preview.png';
}
@endphp
<div class="text-left">
    <a href="{{url('admin/Category/Manage')}}"><button type="button" class="btn bg-navy btn-flat margin">Back</button>
    </a>
 </div>
 <div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Category</h3>
        @if(session('success'))
        <x-alert type="success" :msg="session('success')"/>
     @endif
    </div>
    <form method="post" action="{{route('category.insert')}}" enctype="multipart/form-data">
        @csrf
    <div class="box-body">

        <div class="form-group row">
            <label for="category_name" class="col-sm-2 col-form-label text-center">Name</label>
            <div class="col-sm-7">
               <input type="text" class="form-control" required="" id="category_name" name="category_name"  placeholder="Name" value={{$category_name}}>
               <input type="hidden" name="category_id" value="{{$category_id}}">
               <span class="error_msg">
                @error('category_name')
                {{$message}}
                @enderror
                </span>
            </div>
            
            
         </div>

         <div class="form-group row">
            <label for="category_name" class="col-sm-2 col-form-label text-center">Slug</label>
            <div class="col-sm-7">
               <input type="text" class="form-control" required="" id="category_slug" name="category_slug"  placeholder="Slug" value={{$category_slug}} >
               <span class="error_msg">
                @error('category_slug')
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
               <img id="previewImg" src="{{asset('storage/media/'.$category_image)}}" alt="Uploaded Image Preview Holder" width="200px" height="200px">
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
            <center><a href="{{url('admin/Category')}}" class="btn bg-orange btn-flat margin" >Close</a><input name="category_add" value="Save" type="submit" class="btn bg-maroon btn-flat margin" id="Save"></center>
         </div>
    
    
</form>
    <!-- /.box-body -->
  </div>
 
  @endsection