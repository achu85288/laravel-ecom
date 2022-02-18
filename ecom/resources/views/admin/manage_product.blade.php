@extends('admin/layout')
@section('title')
@endsection
@section('header')
Product
@endsection
@section('product_select','active')
@section('main')
<div class="row">
   @if(session('success'))
   <x-alert type="success" :msg="session('success')"/>
   @endif
   @if($errors->any())
   {{ implode('', $errors->all('
   <div>:message</div>
   ')) }}
   @endif
   <form method="post" action="{{route('product.insert')}}" enctype="multipart/form-data">
      @csrf
      <div class="col-lg-8">
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Product Information</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">Product Name <span class="text-danger">*</span></label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="product_name" placeholder="Product Name" value="">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">Slug<span class="text-danger">*</span></label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" id="product_slug" name="product_slug"  placeholder="Product Name" value="">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">Category <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                     <select class="form-control"  id="category_id" name="category" >
                        <option value="">-Select-</option>
                        @foreach($data['category'] as $category){                                       
                        <option value={{$category->id}}>{{$category->category_name}}</option>
                        }
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">Sub Category <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                     <select class="form-control"  id="sub_category_id" name="sub_category">
                        <option value="">-Select Category First-</option>
                     </select>
                  </div>
               </div>
               <script>
                  $(document).ready(function(){
                   
                   $('#category_id').change(function(){
                     var nested_sub_category_id = $("#nested_sub_category_id").val('');
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
                  <label class="col-md-3 col-from-label">Nested Category <span class="text-danger">*</span></label>
                  <div class="col-sm-8">
                     <select class="form-control"  id="nested_sub_category_id" name="nested_category">
                        <option value="">-Select Sub Category First-</option>
                     </select>
                  </div>
               </div>
               <script>
                  $(document).ready(function(){
                   
                   $('#sub_category_id').change(function(){
                      var category = $("#category_id").val();
                      var sub_category = $("#sub_category_id").val();
                      $.ajaxSetup({
                         headers: {
                            'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                         }
                   });
                      $.ajax({
                         
                         url: "{{ url('ajax/nestedsubcategory') }}",
                         method: 'post',
                         data: {
                            name: "sub_category",
                           category: category,
                           sub_category:sub_category
                         },
                         success: function(response){
                            $("#nested_sub_category_id").html(response);
                        }});
                      });
                   });
                  
                  
               </script> 
               <div class="form-group row" id="brand">
                  <label class="col-md-3 col-from-label">Brand</label>
                  <div class="col-md-8">
                     <select class="form-control"  id="brand" name="brand" >
                        <option value="">-Select-</option>
                        @foreach($data['brand'] as $brand){                                       
                        <option value={{$brand->id}}>{{$brand->brand_name}}</option>
                        }
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">Unit</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="unit" placeholder="Unit (e.g. KG, Pc etc)" value="">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">Minimum Purchase Qty <span class="text-danger">*</span></label>
                  <div class="col-md-8">
                     <input type="number"  class="form-control" name="max_purchase_qty" value="1" min="1" value="">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">Barcode</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="barcode" placeholder="Barcode">
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <style>
            .m-b{
            margin-bottom:10px;
            }
         </style>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Product Images</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="signinSrEmail">Gallery</label>
               </div>
               <div class="form-group row">
                  <div class="col-md-4 m-b" >
                     <input type="file"  multiple  class="form-control" id="files" name="product_image[]" >
                  </div>
                  <div class="col-md-2">
                     <button type="button" class="btn btn-success btn-xs" id="add_attr_div">Add</button>
                  </div>
                  <div id="append_attr_row"></div>
                  <script>
                     $(document).ready(function(){
                         
                         
                         var counter = 0;
                         
                         $("#add_attr_div").on('click',function(){
                             counter++;
                         
                         var html = `<div id="append_attr_div${counter}" >
                           <div class="col-md-4 m-b">
                     <input type="file"  multiple  class="form-control" id="files${counter}" name="product_image[]" >
                     
                     
                     </div>
                     
                     
                      
                        <div class="col-md-2">
                           <button type="button" class="btn btn-danger btn-xs"  onclick ="remove_attr_div(${counter})" >Remove</button>
                        </div>
                        </div>
                        `;
                             $("#append_attr_row").append(html);
                         });
                     });
                     
                     function remove_attr_div(id){
                         $("#append_attr_div"+id).remove();
                     }
                     
                     function attr_previewFile(input,id){
                          var file = $("#attr_picture"+id).get(0).files[0];
                     
                          if(file){
                              var reader = new FileReader();
                     
                              reader.onload = function(){
                                  $("#attr_previewImg"+id).attr("src", reader.result);
                              }
                     
                              reader.readAsDataURL(file);
                          }
                      }
                  </script>
               </div>
               <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="signinSrEmail">Thumbnail Image <small>(300x300)</small></label>
               </div>
               <div class="form-group row">
                  <div class="col-md-8">
                     <input type="file"    class="form-control" id="picture" name="thumbnail" >
                     <div class="file-preview box sm">
                     </div>
                     <small class="text-muted">This image is visible in all product box. Use 300x300 sizes image. Keep some blank space around main object of your image as we had to crop some edge in different devices to make it responsive.</small>
                     <br><img id="previewHolder" src="https://aardetilt.tk/ecommerce/assets/images/image_preview.png" altvalue="" width="50px" height="50px">
                  </div>
                  <script>
                     function readURL(input) {
                      if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                          $('#previewHolder').attr('src', e.target.result);
                        }
                     
                        reader.readAsDataURL(input.files[0]);
                      }
                     }
                     
                     $("#picture").change(function() {
                      readURL(this);
                     });
                  </script>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Product Videos</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">Video Link</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="video_link" placeholder="Video Link">
                     <small class="text-muted">Use proper link without extra parameter. Don't use short share link/embeded iframe code.</small>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Product price + stock</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">Unit price <span class="text-danger">*</span></label>
                  <div class="col-md-6">
                     <input type="number"  min="0" value="0" step="0.01" placeholder="Unit price" name="unit_price" class="form-control" id="unit_price" >
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">Unit Mrp <span class="text-danger">*</span></label>
                  <div class="col-md-6">
                     <input type="number" id="unit_mrp" min="0" value="0" step="0.01" placeholder="Unit Mrp" name="unit_mrp" class="form-control" >
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">
                  Set Point
                  </label>
                  <div class="col-md-6">
                     <input type="number"  min="0" value="0" step="1" placeholder="1" name="reward_point" class="form-control">
                  </div>
               </div>
               <div id="show-hide-div" style="display: none;">
                  <div class="form-group row">
                     <label class="col-md-3 col-from-label">Quantity <span class="text-danger">*</span></label>
                     <div class="col-md-6">
                        <input type="number"  min="0" value="0" step="1" placeholder="Quantity" name="current_stock" class="form-control" value="">
                     </div>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">
                  External link
                  </label>
                  <div class="col-md-9">
                     <input type="text" placeholder="External link" name="external_link" class="form-control">
                     <small class="text-muted">Leave it blank if you do not use external site link</small>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">
                  External link button text
                  </label>
                  <div class="col-md-9">
                     <input type="text" placeholder="External link button text" name="external_link_btn" class="form-control">
                     <small class="text-muted">Leave it blank if you do not use external site link</small>
                  </div>
               </div>
               <br>
            </div>
            <!-- /.box-body -->
         </div>
         <link rel="stylesheet" type="text/css" href="https://aardetilt.tk/ecommerce/admin/assets/css/jquery.multiselect.css"/>
         <script src="https://aardetilt.tk/ecommerce/admin/assets/js/jquery.multiselect.js" ></script>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Product Variation</h3>
            </div>
            <div class="box-body">
               <div class="form-group row gutters-5">
                  <div class="col-md-3">
                     <input type="text" class="form-control" readonly value="Colors" disabledvalue="">
                  </div>
                  <div class="col-md-8">
                     <select class="form-control  select-multi" multiple="multiple" id="color" data-placeholder="Select Colors" onchange="color_attr();" name="color[]"
                        style="width: 100%;">
                        @foreach($data['color'] as $color)                                      
                        <option value={{$color->id}}>{{$color->color_name}}</option>
                        @endforeach
                     </select>
                  </div>
               </div>
               <div class="form-group row gutters-5">
                  <div class="col-md-3">
                     <input type="text" class="form-control" value="Attributes" readonly="">
                  </div>
                  <div class="col-md-8">
                     <select class="form-control select-multi" multiple   id="product_attribute" name="product_attribute[]" data-placeholder="Select Attributes">
                        @foreach($data['attribute'] as $attribute)              
                        @if($attribute->id !=1)                     
                        <option value={{$attribute->id}}>{{$attribute->product_attribute_name}}</option>
                        @endif
                        @endforeach
                     </select>
                  </div>
               </div>
               <div id="variations">
                  <div class="text-right">
                     <button type="button" class="btn btn-xs btn-info" onclick="call()">Make Combinations</button>
                  </div>
               </div>
               <script>
                  $('.select-multi').multiselect({
                      columns: 1,
                      placeholder: 'Select',
                      search: true,
                      selectAll: true
                  });
                  
                  
               </script>
               <script>
                  function color_attr() {
                      var selectedOptions = []; var opt_val;
                          $('#color option:selected').each(function(){
                              opt_val = 'color'+'~'+$(this).text()+'~'+$(this).val();
                          selectedOptions.push(opt_val);
                      });
                      return selectedOptions;
                  }
                  function call()
                  {
                      var price = $("#unit_price").val();
                      var mrp = $("#unit_mrp").val();
                      var output = [];
                      var color = color_attr();           
                      
                      var arr =[
                          color
                      ]
                     console.log(arr)
                     detectCombinations(arr, output);
                     printArray(output,price,mrp);
                  }
                  
                  function detectCombinations(input, output, position=0, path=[]) 
                  {
                      if (position < input.length) {
                          var item = input[position];
                          for (var i = 0; i < item.length; ++i) {
                              var value = item[i];
                              path.push(value);
                              detectCombinations(input, output, position + 1, path);
                              path.pop();
                          }
                      } else {
                          output.push(path.slice());
                      }
                  };
                  
                  
                  function printArray(array,price='',mrp='') 
                  {
                       for (var i = 0; i < array.length; ++i) {
                            array[i].join(' - ');
                      }
                      $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                          }
                      });
                      $.ajax({            
                          url: "{{ route('ajax.choice')}}",
                          method: 'post',
                          data: {
                              name: "choice",
                              choice: array,
                              price:price,
                              mrp:mrp
                          },
                          success: function(response){
                              $("#choice").html(response.get_choice); 
                            // console.log(response) 
                      }});                     
                   }
               </script>
               <script>
                  $("#product_attribute").on('change',function(){
                     var attribute = $(this).val();
                     $.ajaxSetup({
                           headers: {
                              'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                           }
                     });
                  
                     $.ajax({                    
                        url: "{{ route('ajax.productattribute') }}",
                        method: 'post',
                        data: {
                           name: "productattribute",
                           attribute: attribute
                        },
                        success: function(response){
                           $("#variations").html(response.get_data);     
                      }});
                  })
                  
                  function color_attr()  {
                     var color_name = []; var col_val="";
                        $(`#color option:selected`).each(function(){
                           col_val = 'color'+'~'+$(this).text()+'~'+$(this).val();
                        color_name.push(col_val);
                     });
                     
                     return color_name;
                  }
                  
                  
                  
               </script>
               <div>
                  <p>Choose the attributes of this product and then input values of each attribute</p>
                  <br>
                  <div id="choice"></div>
               </div>
               <div id="select_file"></div>
               <div class="customer_choice_options" id="customer_choice_options"></div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Product Description</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label for="short_desc" class="col-sm-2 col-form-label ">Short Description</label>
                  <div class="col-sm-8">
                     <textarea class="form-control"   id="short_desc" name="short_desc" placeholder="Short Description"></textarea>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="long_desc" class="col-sm-2 col-form-label ">Long Description</label>
                  <div class="col-sm-8">
                     <textarea class="form-control"   id="long_desc" name="long_desc" placeholder="Long Description"></textarea>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="technical_specification" class="col-sm-2 col-form-label ">Technical Specification</label>
                  <div class="col-sm-8">
                     <textarea class="form-control"   id="technical_specification" name="technical_specification" placeholder="Long Description"></textarea>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="uses" class="col-sm-2 col-form-label ">Uses</label>
                  <div class="col-sm-8">
                     <textarea class="form-control"   id="uses" name="uses" placeholder="Uses"></textarea>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="warranty" class="col-sm-2 col-form-label ">Warranty</label>
                  <div class="col-sm-8">
                     <textarea class="form-control"   id="warranty" name="warranty" placeholder="Warranty"></textarea>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-2 col-from-label">Tags <span class="text-danger">*</span></label>
                  <div class="col-md-8">
                     <input id="tags_1" type="text" class="tags form-control" value="ruby,android,kindle" name="keywords"/></p>
                     <small class="text-muted">This is used for search. Input those words by which cutomer can find this product.</small>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">PDF Specification</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-3 col-form-label" for="signinSrEmail">PDF Specification</label>
                  <div class="col-md-8">
                     <input type="file"  name="pdf" class="form-control">
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">SEO Meta Tags</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">Meta Title</label>
                  <div class="col-md-8">
                     <input type="text" class="form-control" name="meta_title" placeholder="Meta Title">
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-3 col-from-label">Description</label>
                  <div class="col-md-8">
                     <textarea name="meta_description" rows="8" class="form-control"></textarea>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
      </div>
      <div class="col-lg-4">
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Shipping Configuration</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-6 col-from-label">Status</label>
                  <div class="col-md-6">
                     <label class="aiz-switch aiz-switch-success mb-0">
                     <input type="checkbox" name="is_shipping" value="1"  id="free">
                     <span></span>
                     </label>
                  </div>
               </div>
               <div class="flat_rate_shipping_div" style="display: none;">
                  <div class="form-group row">
                     <label class="col-md-3 col-from-label">Shipping cost</label>
                     <div class="col-md-4">
                        <input type="number" placeholder="Shipping cost" name="shipping_cost" class="form-control" value="">
                     </div>
                     <div class="col-md-5">
                        <select class="form-control " name="shipping_type" id="shipping_type">
                           <option value="">Choose</option>
                           <option value="1">Flat</option>
                           <option value="2">Percent</option>
                        </select>
                     </div>
                  </div>
               </div>
               <script>
                  $("#free").on('change',function(){
                     if ($("#free").prop("checked")){
                        $(".flat_rate_shipping_div").show();
                     }
                     else{
                        $(".flat_rate_shipping_div").hide();
                     }
                  });
               </script>
            </div>
            <!-- /.box-body -->
         </div>
         <script>
            $("input[name='discount_type']").on('change',function(){
               if ($("#time_bound").prop("checked")){
                  $("#disp_disc").show();
               }
               else{
                  $("#disp_disc").hide();
               }
            });
         </script>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Low Stock Quantity Warning</h3>
            </div>
            <div class="box-body">
               <div class="form-group mb-3">
                  <label for="name">
                  Quantity
                  </label>
                  <input type="number" name="qty_warning" value="1" min="0" step="1" class="form-control">
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Stock Visibility State</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-6 col-from-label">Show Stock Quantity</label>
                  <div class="col-md-6">
                     <label class="aiz-switch aiz-switch-success mb-0">
                     <input type="radio" name="stock_visibility_state" value="1" checkedvalue="">
                     <span></span>
                     </label>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-6 col-from-label">Show Stock With Text Only</label>
                  <div class="col-md-6">
                     <label class="aiz-switch aiz-switch-success mb-0">
                     <input type="radio" name="stock_visibility_state" value="2">
                     <span></span>
                     </label>
                  </div>
               </div>
               <div class="form-group row">
                  <label class="col-md-6 col-from-label">Hide Stock</label>
                  <div class="col-md-6">
                     <label class="aiz-switch aiz-switch-success mb-0">
                     <input type="radio" name="stock_visibility_state" value="3">
                     <span></span>
                     </label>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Cash On Delivery</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-6 col-from-label">Status</label>
                  <div class="col-md-6">
                     <label class="aiz-switch aiz-switch-success mb-0">
                     <input type="checkbox" name="cod" value="1" checkedvalue="">
                     <span></span>
                     </label>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Promo</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-6 col-from-label">Status</label>
                  <div class="col-md-6">
                     <label class="aiz-switch aiz-switch-success mb-0">
                     <input type="checkbox" name="is_promo" value="1" checkedvalue="">
                     <span></span>
                     </label>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Trending</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-6 col-from-label">Status</label>
                  <div class="col-md-6">
                     <label class="aiz-switch aiz-switch-success mb-0">
                     <input type="checkbox" name="is_trending" value="1" checkedvalue="">
                     <span></span>
                     </label>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Featured</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-6 col-from-label">Status</label>
                  <div class="col-md-6">
                     <label class="aiz-switch aiz-switch-success mb-0">
                     <input type="checkbox" name="is_featured" value="1" checkedvalue="">
                     <span></span>
                     </label>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Refundable</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-6 col-from-label">Status</label>
                  <div class="col-md-6">
                     <label class="aiz-switch aiz-switch-success mb-0">
                     <input type="checkbox" name="is_refundable" value="1" checkedvalue="">
                     <span></span>
                     </label>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Todays Deal</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-6 col-from-label">Status</label>
                  <div class="col-md-6">
                     <label class="aiz-switch aiz-switch-success mb-0">
                     <input type="checkbox" name="todays_deal" value="1" checkedvalue="">
                     <span></span>
                     </label>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Flash Deal</h3>
            </div>
            <div class="box-body">
               <div class="form-group mb-3">
                  <label for="name">
                  Add To Flash
                  </label>
                  <select class="form-control " name="deal" id="flash_deal">
                     <option value="">Choose Flash Title</option>
                     <option value="1">
                        Winter Sell
                     </option>
                     <option value="2">
                        Falsh sale
                     </option>
                  </select>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Estimate Shipping Time</h3>
            </div>
            <div class="box-body">
               <div class="form-group mb-3">
                  <label for="name">
                  Shipping Days
                  </label>
                  <div class="input-group">
                     <input type="number" class="form-control" name="estimate_shipping_day" min="1" step="1" placeholder="Shipping Days">
                     <div class="input-group-addon">
                        Days
                     </div>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Vat &amp; TAX</h3>
            </div>
            <div class="box-body">
               <label for="name">
               Tax
               </label>
               <div class="form-row">
                  <div class="form-group col-md-6">
                     <select class="form-control"  id="tax" name="tax">
                        <option value=""> -Select-</option>
                     </select>
                  </div>
                  <div class="form-group col-md-6">
                     <select class="form-control " name="tax_type">
                        <option value="">-Choose-</option>
                        <option value="1">Flat</option>
                        <option value="2">Percent</option>
                     </select>
                  </div>
               </div>
            </div>
            <!-- /.box-body -->
         </div>
         <div class="box box-warning">
            <div class="box-header">
               <h3 class="box-title">Discount</h3>
            </div>
            <div class="box-body">
               <div class="form-group row">
                  <label class="col-md-6 col-from-label">Status</label>
                  <div class="col-md-6">
                     <label class="aiz-switch aiz-switch-success mb-0">
                     <input type="checkbox" name="is_discount" id="is_discount" value="1">
                     <span></span>
                     </label>
                  </div>
               </div>
               <div id="disp_disc_div" style="display:none;">
                  <div class="form-group row">
                     <label for="discount_type" class="col-md-12 col-from-label">Disount Type</label>
                     <div class="col-md-6">
                        <input type="radio"   checked id="permanent" name="discount_type" value="1" placeholder="Lead Time">
                        <label for="discount_type" class="col-form-label ">Permanent</label>
                     </div>
                     <div class="col-md-6">
                        <input type="radio"   id="time_bound" name="discount_type" value="2" placeholder="Lead Time">
                        <label for="discount_type" class="col-form-label ">Time Bound</label>
                     </div>
                  </div>
                  <div class="form-group row">
                     <label for="discount_value" class="col-md-3 col-from-label">Discount</label>
                     <div class="col-sm-3">
                        <input class="form-control"  id="discount_value" name="discount_value">
                     </div>
                     <div class="col-sm-5">
                        <select class="form-control"  id="disc_type" name="disc_type">
                           <option value="">-Choose-</option>
                           <option value='1'>Flat</option>
                           <option value="2">Percent</option>
                        </select>
                     </div>
                  </div>
                  <div id="disp_disc" style="display:none;">
                     <div class="form-group row">
                        <label for="start_dttm" class="col-md-6 col-from-label">Start Date/Time</label>
                        <div class="col-sm-6">
                           <input class="form-control dttm"  id="start_dttm" name="start_dttm" type="datetime-local">
                        </div>
                     </div>
                     <div class="form-group row">
                        <label for="end_dttm" class="col-md-6 col-from-label">End Date/Time</label>
                        <div class="col-sm-6">
                           <input class="form-control dttm"  type="datetime-local"id="end_dttm" name="end_dttm">
                        </div>
                     </div>
                  </div>
               </div>
               <script>
                  $("input[name='discount_type']").on('change',function(){
                     if ($("#time_bound").prop("checked")){
                        $("#disp_disc").show();
                     }
                     else{
                        $("#disp_disc").hide();
                     }
                  });
                  
                  $("#is_discount").on('change',function(){
                     if ($("#is_discount").prop("checked")){
                        $("#disp_disc_div").show();
                     }
                     else{
                        $("#disp_disc_div").hide();
                     }
                  });
               </script>
            </div>
            <!-- /.box-body -->
         </div>
      </div>
      <div class="col-lg-12">
         <div class="btn-toolbar float-right mb-3" role="toolbar" aria-label="Toolbar with button groups">
            <div class="btn-group" role="group" aria-label="Second group">
               <button type="submit" name="product_add" value="publish" class="btn btn-success">Save &amp; Publish</button>
            </div>
         </div>
      </div>
   </form>
</div>
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<link rel="stylesheet" href="https://aardetilt.tk/ecommerce/admin/assets/css/jquery.tagsinput.css">
<script src="https://aardetilt.tk/ecommerce/admin/assets/js/jquery.tagsinput.js" defer></script>
<script type="text/javascript">
   $(function() {
       $('#tags_1').tagsInput({width:'auto'});
   });
</script>
<script>
   CKEDITOR.replace('long_desc');
   CKEDITOR.replace('terms');
   CKEDITOR.replace('technical_specification');
   CKEDITOR.replace('warranty');
   
</script>
@endsection