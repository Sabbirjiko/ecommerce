@extends('layouts.admin_layouts.admin_main')
@section('content')
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin_dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="{{ route('products') }}" title="Products" class="tip-bottom">Products</a><a href="{{ route('products.attributes',$product->id) }}" title="Product Attributes" class="tip-bottom current">{{$product->product_name}} - Attributes</a></div>
    <h1>{{$product->product_name}} - Attributes</h1>
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
                  <h5>{{$product->product_name}} - attributes</h5>
                </div>
                <div class="widget-content">
                  <label class="control-label">Product Name : <strong>{{$product->product_name}}</strong></label>
                    
                  <label class="control-label">Product Code : <strong>{{$product->product_code}}</strong></label>
                    
                  <label class="control-label">Product Color : {{$product->product_color}} </label>
                  <a class="btn btn-success" href="{{ route('products.add_attributes',$product->id) }}">Add new attributes</a>   
                </div>
                <div class="widget-content">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Attribute Id</th>
                        <th>SKU</th>
                        <th>Size</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($product->attributes as $attribute)
                      <tr class="gradeX">
                        <td>{{$attribute->id}}</td>
                        <td>{{$attribute->sku}}</td>
                        <td>{{$attribute->size}}</td>
                        <td>৳-{{$attribute->price}}</td>
                        <td>{{$attribute->stock}}</td>
                        <td>
                          <a href="#myAlert{{$attribute->id}}" data-toggle="modal" class="btn btn-danger btn-mini">Delete</a>
                          <!-- Delete Modal -->
                            <div id="myAlert{{$attribute->id}}" class="modal hide">
                              <div class="modal-header">
                                <button data-dismiss="modal" class="close" type="button">×</button>
                                <h3>Attribute Delete</h3>
                              </div>
                              <div class="modal-body">
                                <p>Are you sure to delete <b>"{{$attribute->sku}}"</b>?</p>
                              </div>
                              <div class="modal-footer"> 
                                <a class="btn btn-danger" href="{{ route('products.deleteattribute',$attribute->id) }}">Confirm</a> <a data-dismiss="modal" class="btn btn-primary" href="#">Cancel</a> 
                              </div>
                            </div>
                        <!-- Delete Modal End -->
                        </td>
                      </tr>
                      @empty
                      <p>No Data Found</p>
                      @endforelse
                    </tbody>
                  </table>
                </div>       
            </div>
          </div>
      </div>
  </div>

</div>
@endsection
@section('scripts')

@stop