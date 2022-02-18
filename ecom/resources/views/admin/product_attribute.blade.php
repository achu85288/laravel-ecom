@extends('admin/layout')
@section('title')
Product Attribute
@endsection
@section('header')
Product Attribute
@endsection
@section('product_attribute_select','active')
@section('main')
<div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Product Attribute</h3>
        </div>
  
          <div class="box-body">
            <table id="example" class="table table-bordered table-responsive table-hover">
                <thead>
                <tr>
                    <th>Sr No.</th>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                      <td>{{$item->id}}</td>
                      <td>{{$item->product_attribute_name}}</td>
                      <td>
                        @foreach ($values as $val) 
                            @if ($val->product_attribute_id == $item->id)
                            <span class="badge badge-inline badge-md bg-soft-dark" style="color: #000;"> 
                                {{$val->product_attribute_value}}
                            </span>                          
                            @endif
                        @endforeach</td>
                      <td>
                         @if($item->status ==1)
                         <a href="{{url('admin/ProductAttribute/0/'.$item->id)}}" class="btn bg-maroon btn-flat margin btn-sm">Active</a>
                         @else
                         <a href="{{url('admin/ProductAttribute/1/'.$item->id)}}" class="btn bg-orange btn-flat margin btn-sm">Deactive</a>
                         @endif
                        
                      </td>
                      <td class="text-right footable-last-visible" style="display: table-cell;">
                        <a class="btn btn-soft-info btn-icon btn-circle btn-sm" href="{{url('admin/ProductAttributeValue/'.$item->id)}}" title="Attribute values">
                        <i class="fa fa-cog"></i>
                        </a>
                        <a class="btn btn-soft-primary btn-icon btn-circle btn-sm" href="{{url('admin/ProductAttribute/'.$item->id)}}" title="Edit">
                        <i class="fa fa-edit"></i>
                        </a>
                        <a href="{{url('admin/ProductAttribute/Delete/'.$item->id)}}" onclick="return confirm('are you sure ?')" class="btn btn-soft-danger btn-icon btn-circle btn-sm confirm-delete"><i class=" fa fa-trash"></i></a>
                     
                     </td>
                    </tr>
                    @endforeach
               
                </tbody>
        
              </table>
      </div></div>
    </div>
    <!--/.col (left) -->
    <!-- right column -->
    <div class="col-md-6">
      <!-- Horizontal Form -->
      <div class="box box-warning">
        <div class="box-header with-border">
          <h3 class="box-title">Add New Attribute</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        @php
        if(!empty($updt_model)){
            $attr_id = $updt_model->id;
            $attr_name = $updt_model->product_attribute_name;
                    
        }            
        else{
           $attr_id =0;
           $attr_name ='';
        }
        @endphp
        <form action="{{route('product_attribute.insert')}}" method="POST"class="form-horizontal">
            @csrf
          <div class="box-body">
            <div class="form-group">
              <label for="product_attribute_name" class="col-sm-2 control-label">Name</label>

              <div class="col-sm-10">
                <input type="text" class="form-control" name="product_attribute_name" id="product_attribute_name" placeholder="Name" value={{$attr_name}}>
                <input type="hidden" name="product_attribute_id" value="{{$attr_id}}">
                <span class="error_msg">
                    @error('product_attribute_name')
                    {{$message}}
                    @enderror
                    </span>
              </div>
            </div>
          
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="reset" class="btn btn-default">Reset</button>
            <button type="submit" class="btn btn-info pull-right">Save</button>
          </div>
          <!-- /.box-footer -->
        </form>
      </div>

    </div>
    <!--/.col (right) -->
  </div>
@endsection