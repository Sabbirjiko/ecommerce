@extends('layouts.admin_layouts.admin_main')
@section('content')
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin_dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="{{ route('products') }}" title="Products" class="tip-bottom current">Products</a></div>
    <h1>Products</h1>
    <h3 style="margin-left: 2%"><a href="{{route('products.add')}}" class="btn btn-success">Add New</a></h3>
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
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Product Color</th>
                        <th>Product Code</th>
                        <th>Price</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($products as $product)
                      <tr class="gradeX">
                          <td>{{$product->id}}</td>
                          <td>@if(!empty($product->image))
                            <img src="{{ asset('images/backend_images/products/small/'.$product->image) }}" style="display: block;margin-left: auto;margin-right: auto;width: 30px;">
                            @endif
                          </td>
                          <td style="text-align: center;">{{$product->product_name}}</td>
                          <td style="text-align: center;">{{$product->category->name}}</td>
                          <td style="text-align: center;">{{$product->product_color}}</td>
                          <td style="text-align: center;">{{$product->product_code}}</td>
                          <td style="text-align: center;">৳-{{$product->price}}</td>
                          <td style="text-align: center;">
                            <a href="{{ route('products.attributes',$product->id) }}" class="btn btn-primary btn-mini" style="margin-left: 2px;"><i class="fa fa-edit"></i>Attributes</a>
                            <a href="#myModal{{$product->id}}" data-toggle="modal" class="btn btn-success btn-mini" style="margin-left: 2px;">View</a>
                            <a href="{{ route('products.edit',$product->id) }}" class="btn btn-primary btn-mini" style="margin-left: 2px;"><i class="fa fa-edit"></i>Edit</a>
                            <a href="#myAlert{{$product->id}}" data-toggle="modal" class="btn btn-danger btn-mini">Delete</a>
                            <!-- View Modal Start -->
                            <div id="myModal{{$product->id}}" class="modal hide" aria-hidden="true" style="display: none;">
                              <div class="modal-header">
                                <button data-dismiss="modal" class="close" type="button">×</button>
                                <h3>{{$product->product_name}} Details</h3>
                              </div>
                              <div class="modal-body">
                                <table class="table">
                                  <tbody>
                                    <tr>
                                      <th>Product name : </th><td>{{$product->product_name}}</td>
                                    </tr>
                                    <tr><th>Category</th><td>{{$product->category->name}}</td></tr>
                                    <tr><th>Product Code</th><td>{{$product->product_code}}</td></tr>
                                    <tr><th>Product Color</th><td>{{$product->product_color}}</td></tr>
                                    <tr><th>Price</th><td>{{$product->price}}</td></tr>
                                    <tr><th>Description</th><td><textarea>{{$product->description}}</textarea></td></tr>
                                  </tbody>
                                </table>
                              </div>
                              <div class="modal-footer"> 
                                <a data-dismiss="modal" class="btn btn-primary" href="#">Close</a> 
                              </div>
                            </div>
                          <!-- Delete Modal -->
                            <div id="myAlert{{$product->id}}" class="modal hide">
                              <div class="modal-header">
                                <button data-dismiss="modal" class="close" type="button">×</button>
                                <h3>Product Delete</h3>
                              </div>
                              <div class="modal-body">
                                <p>Are you sure to delete <b>"{{$product->product_name}}"</b>?</p>
                              </div>
                              <div class="modal-footer"> 
                                <a class="btn btn-danger" href="{{ route('products.delete',$product->id) }}">Confirm</a> <a data-dismiss="modal" class="btn btn-primary" href="#">Cancel</a> 
                              </div>
                            </div>
                          <!-- Delete Modal End -->
                          </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
        		</div>
      		</div>
    	</div>
  </div>
</div>
@endsection