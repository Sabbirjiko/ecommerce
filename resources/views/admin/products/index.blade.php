@extends('layouts.admin_layouts.admin_main')
@section('content')
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin_dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="{{ route('products') }}" title="Products" class="tip-bottom current">Products</a></div>
    <h1>Products</h1>
    @if(Session::has('flash_error_message'))
      <div class="alert alert-danger alert-block" >
          <button type="button" class="close" data-dismiss="alert" ><span aria-hidden="true">&times;</span></button>
          <strong>{{Session('flash_error_message')}}</strong>
      </div>
    @endif
    @if(Session::has('flash_success_message'))
      <div class="alert alert-success alert-block" >
          <button type="button" class="close" data-dismiss="alert" ><span aria-hidden="true">&times;</span></button>
          <strong>{{Session('flash_success_message')}}</strong>
      </div>
    @endif 
  </div>
<!--End-breadcrumbs-->
	<div class="container-fluid"><hr>
	    <div class="row-fluid">
      		<div class="span12">
        		<div class="widget-box">
          			<div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            			<h5>Products</h5>
          			</div>
                <div class="widget-content nopadding">
                  <table class="table table-bordered data-table">
                    <thead>
                      <tr>
                        <th>Id</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($products as $product)
                      <tr class="gradeX">
                          <td>{{$product->id}}</td>
                          <td>{{$product->product_name}}</td>
                          <td>{{$product->category->name}}</td>
                          <td>{{$product->description}}</td>
                          <td><a href="{{ route('products.edit',$product->id) }}" class="btn btn-primary btn-mini" style="margin-right: 2px;">Edit</a><a href="#myAlert" data-toggle="modal" class="btn btn-danger btn-mini">Delete</a></td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  <div id="myAlert" class="modal hide">
                      <div class="modal-header">
                        <button data-dismiss="modal" class="close" type="button">×</button>
                        <h3>Category Delete</h3>
                      </div>
                      <div class="modal-body">
                        <p>Are you sure to delete <b>"{{ $product->name }}"</b> Category ??</p>
                      </div>
                      <div class="modal-footer"> 
                        <a class="btn btn-danger" href="{{ route('products.delete',$product->id) }}">Confirm</a> <a data-dismiss="modal" class="btn btn-primary" href="#">Cancel</a> 
                      </div>
                    </div>
                </div>
        		</div>
      		</div>
    	</div>
	</div>
</div>
@endsection