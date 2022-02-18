@extends('admin/layout')
@section('title')
NestedSubCategory
@endsection
@section('header')
Nested SubCategory
@endsection
@section('sub_category_select','active')
@section('main')
@php
if(!empty($data)){
   foreach($data as $item){
      $nested_sub_category_id = $item->id;
      $nested_sub_category_name = $item->nested_sub_category_name;
      $category_id=$item->category_id;
      $sub_category_id=$item->sub_category_id;
   }            
}            
else{
   $nested_sub_category_id =0;
   $nested_sub_category_name = $category_id=$sub_category_id='';            
}
@endphp
<div class="text-left">
    <a href="{{url('admin/NestedSubCategory/Manage')}}"><button type="button" class="btn bg-navy btn-flat margin">Back</button>
    </a>
 </div>
 <div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">Nested SubCategory</h3>
        @if(session('success'))
        <x-alert type="success" :msg="session('success')"/>
     @endif
    </div>
    <form method="post" action="{{route('nested_sub_category.insert')}}" enctype="multipart/form-data">
        @csrf
    <div class="box-body">

        <div class="form-group row">
            <label for="category_name" class="col-sm-2 col-form-label text-center">Category</label>
            <div class="col-sm-8">
              <select class="form-control"  id="category_id" name="category_id" >
                 <option value="">-Select-</option>
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
            <label for="category_name" class="col-sm-2 col-form-label text-center">Sub Category</label>
            <div class="col-sm-8">
               <select class="form-control"  id="sub_category_id" name="sub_category_id" >
                <option value="">-Select-</option>
                  @if ($sub_category_id != "")
                    @foreach($sub_category as $sub_cat){                                       
                       <option value={{$sub_cat->id}} 
                       @if ($sub_category_id == $sub_cat->id)
                          {{"selected = selected"}}
                       @endif>{{$sub_cat->sub_category_name}}</option>
                       }
                       @endforeach
            
                    @endif

               </select>
               <span class="error_msg">
                @error('sub_category_id')
                {{$message}}
                @enderror
               </span>
            </div>
         </div>
         
         <script>
             $(document).ready(function(){
              
              $('#category_id').change(function(){
                 var category = $("#category_id").val();
                 $.ajaxSetup({
                    headers: {
                       'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    }
              });
                 $.ajax({
                    
                    url: "{{ url('ajax/subcategory') }}",
                    method: 'post',
                    data: {
                       name: "sub_category",
                      category: category
                    },
                    success: function(response){
                       $("#sub_category_id").html(response);
                          
                          
                    }});
                 });
              });

           
         </script> 
         
         
    <div class="form-group row">
       <label for="nested_sub_category_name" class="col-sm-2 col-form-label text-center">Name</label>
       <div class="col-sm-8">
          <input type="text" class="form-control" required="" id="nested_sub_category_name" name="nested_sub_category_name"  placeholder="Name" value={{$nested_sub_category_name}}>
       </div>
       <input type="hidden" name="nested_sub_category_id" value="{{$nested_sub_category_id}}">
       <span class="error_msg">
        @error('nested_sub_category_name')
        {{$message}}
        @enderror
       </span>
    </div>
    
   
    
    
         </div>
         <div class="box-footer">
            <center><a href="{{url('admin/NestedSubCategory')}}" class="btn bg-orange btn-flat margin" >Close</a><input name="sub_category_add" value="Save" type="submit" class="btn bg-maroon btn-flat margin" id="Save"></center>
         </div>
    
    
</form>
  </div>
 
  @endsection