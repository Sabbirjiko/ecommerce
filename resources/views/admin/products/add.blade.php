@extends('layouts.admin_layouts.admin_main')
@section('content')
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin_dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="{{ route('products') }}" title="Products" class="tip-bottom">Products</a><a href="{{ route('products.add') }}" title="Add New Product" class="tip-bottom current">New Product</a></div>
    <h1>Add New Product</h1>
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
            			<h5>Add Product</h5>
          			</div>
          			<div class="widget-content nopadding">
            			<form class="form-horizontal" method="post" action="{{route('products.add')}}" name="add_product" id="add_product" enctype="multipart/form-data" >
            				@csrf
              				<div class="control-group">
                				<label class="control-label">Product Name</label>
                				<div class="controls">
                  					<input type="text" name="product_name" id="product_name" required>
                				</div>
              				</div>
							<div class="control-group">
                				<label class="control-label">Product Code</label>
                				<div class="controls">
                  					<input type="text" name="product_code" id="product_code" required>
                				</div>
              				</div>
							<div class="control-group">
                				<label class="control-label">Product Color</label>
                				<div class="controls">
                  					<input type="text" name="product_color" id="product_color" required>
                				</div>
              				</div>
							<div class="control-group">
                				<label class="control-label">Price</label>
                				<div class="controls">
                  					<input type="text" name="price" id="price" required>
                				</div>
              				</div>
                      <div class="control-group">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <textarea name="description" id="description"></textarea>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Category</label>
                        <div class="controls">
                          <select name="category_id" id="category_id" style="width: 25%" required>
                            @foreach($parent_cat as $category)
                              <option value="{{$category->id}}">{{$category->name}}</option>
                            	@foreach($sub_cat as $sub)
                              @if($sub->parent_id == $category->id)
                              		<option value="{{$sub->id}}">&nbsp;--&nbsp;{{$sub->name}}</option>
                                  @endif
                            	@endforeach
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Image</label>
                        <div class="controls">
                            <input type="file" name="image" id="image">
                        </div>
                      </div>
              				<div class="form-actions">
                				<input type="submit" value="Add Product" class="btn btn-success">
              				</div>
            			</form>
          			</div>
        		</div>
      		</div>
    	</div>
	</div>
</div>
@endsection
