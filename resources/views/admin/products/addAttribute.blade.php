@extends('layouts.admin_layouts.admin_main')
@section('content')
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin_dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="{{ route('products') }}" title="Products" class="tip-bottom">Products</a><a href="{{ route('products.attributes',$product->id) }}" title="{{$product->product_name}} - Attributes" class="tip-bottom">{{$product->product_name}} - Attributes</a><a href="{{ route('products.add_attributes',$product->id) }}" title="{{$product->product_name}} -New Attributes Add" class="tip-bottom current">{{$product->product_name}} - New Attributes Add</a></div>
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
                  <h5>{{$product->product_name}} -Add attributes</h5>
                </div>
                <div class="widget-content nopadding">
                  <form class="form-horizontal" method="post" action="{{route('products.add_attributes',$product->id)}}" name="add_attributes" id="add_attributes" enctype="multipart/form-data" >
                    @csrf
                      <div class="control-group">
                        <label class="control-label">Product Name</label>
                        <label class="control-label" style="text-align: center"><strong>{{$product->product_name}}</strong></label>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Product Code</label>
                        <label class="control-label" style="text-align: center"><strong>{{$product->product_code}}</strong></label>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Product Color</label>
                        <label class="control-label"style="text-align: center"><strong>{{$product->product_color}}</strong></label>
                      </div>
                      <div class="control-group">
                        <div class="field_wrapper" style="margin-left: 8%;">
                          <div>
                            <input required type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 120px;"/>
                            <input required type="text" name="size[]" id="size" placeholder="SIZE"  style="width: 120px;"/>
                            <input required type="text" name="price[]" id="price" placeholder="PRICE" style="width: 120px;"/>
                            <input required type="text" name="stock[]" id="stock" placeholder="STOCK" style="width: 120px;"/>
                              <a href="javascript:void(0);" class="add_button" title="Add field"><span><i class="icon-plus"></i></span></a>
                          </div>
                        </div>
                      </div>
                      <div class="form-actions">
                        <input type="submit" value="Add Attributes" class="btn btn-success">
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
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="sku[]" id="sku" placeholder="SKU" style="margin-right: 0.3%;margin-top: .2%;width:120px;"/><input type="text" name="size[]" id="size" placeholder="SIZE" style="margin-right: 0.3%;margin-top: .2%;width:120px;"/><input type="text" name="price[]" id="price" placeholder="PRICE" style="margin-right: 0.3%;margin-top: .2%;width:120px;"/><input type="text" name="stock[]" id="stock" placeholder="STOCK" style="margin-right: 0.3%;margin-top: .2%;width:120px;"/><a href="javascript:void(0);" class="remove_button"><span><i class="icon-minus"style="margin-left:2px;"></span></i></a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
</script>
@stop