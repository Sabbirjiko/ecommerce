@extends('layouts.admin_layouts.admin_main')
@section('content')
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin_dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="{{ route('products') }}" title="Products" class="tip-bottom current">Products</a>{{$product->product_name}}</div>
    <h1>{{$product->product_name}}</h1>
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
            			<h5>{{$product->product_name}} - Details Update</h5>
          			</div>
                <div class="widget-content nopadding">
                  <form class="form-horizontal" method="post" action="{{route('products.edit',$product->id)}}" name="edit_product" id="edit_product" enctype="multipart/form-data" >
                    @csrf
                      <div class="control-group">
                        <label class="control-label">Product Name</label>
                        <div class="controls">
                            <input type="text" name="product_name" id="product_name" value="{{$product->product_name }}">
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Product Code</label>
                        <div class="controls">
                            <input type="text" name="product_code" id="product_code" value="{{$product->product_code}}">
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Product Color</label>
                        <div class="controls">
                            <input type="text" name="product_color" id="product_color" value="{{$product->product_color}}">
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Price</label>
                        <div class="controls">
                            <input type="text" name="price" id="price" value="{{$product->price}}">
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <textarea name="description" id="description">{{$product->description}}</textarea>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Category</label>
                        <div class="controls">
                          <select name="category_id" id="category_id" style="width: 25%" >
                            @foreach($parent_cat as $category)
                              
                              <option value="{{$category->id}}" @if($category->id == $product->category_id)selected @endif >{{$category->name}}</option>
                              @foreach($sub_cat as $sub)
                              @if($sub->parent_id == $category->id)
                                  <option value="{{$sub->id}}" @if($sub->id == $product->category_id)selected @endif >&nbsp;--&nbsp;{{$sub->name}}</option>
                                  @endif
                              @endforeach
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Image</label>
                        <div class="controls">
                          <input type="hidden" name="current_image" value="{{$product->image}}">
                          <img id="blah" @if($product->image == null)src="{{asset('images/no-image.png')}}" @else src="{{asset('images/backend_images/products/small/'.$product->image)}}" @endif style="width: 150px;height: 150px;margin-bottom:5px;"><br>
                            <input type="file" name="image" id="image">
                        </div>
                      </div>
                      <div class="form-actions">
                        <input type="submit" value="Update" class="btn btn-success">
                        
                      </div>
                  </form>
                </div>
        		</div>
      		</div>
    	</div>
  </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
    
      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }
    
      reader.readAsDataURL(input.files[0]);
    }
  }

$("#image").change(function() {
  readURL(this);
});
</script>
@stop