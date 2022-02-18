@extends('admin/layout')
@section('title')
Coupon
@endsection
@section('header')
Coupon
@endsection
@section('coupon_select','active')
@section('main')
<div class="text-right">
    <a href="{{url('admin/Coupon/Manage')}}"><button type="button" class="btn bg-purple btn-flat margin">Add Data</button>
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
            <th>Code</th>
            <th>Value</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
              <td>{{$item->id}}</td>
              <td>{{$item->name}}</td><td>{{$item->code}}</td>
              <td>{{$item->value}}</td>
              <td>
                 @if($item->status ==1)
                 <a href="{{url('admin/Coupon/0/'.$item->id)}}" class="btn bg-maroon btn-flat margin btn-sm">Active</a>
                 @else
                 <a href="{{url('admin/Coupon/1/'.$item->id)}}" class="btn bg-orange btn-flat margin btn-sm">Deactive</a>
                 @endif
                
              </td>
              <td>
                 <a href="{{url('admin/Coupon/Manage/'.$item->id)}}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i></a>
                 <a href="{{url('admin/Coupon/Delete/'.$item->id)}}" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
       
        </tbody>

      </table>
    </div>
    <!-- /.box-body -->
  </div>
@endsection