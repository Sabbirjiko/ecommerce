@extends('layouts.admin_layouts.admin_main')
@section('content')
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin_dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="{{ route('categories') }}" title="Categories" class="tip-bottom">Categories</a><a href="{{ route('categories.add') }}" title="Add New Category" class="tip-bottom current">New Category</a></div>
    <h1>Edit Category - {{ $category->name }}</h1>
  </div>
<!--End-breadcrumbs-->
	<div class="container-fluid"><hr>
	    <div class="row-fluid">
      		<div class="span12">
        		<div class="widget-box">
          			<div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            			<h5>Edit Category - {{ $category->name }}</h5>
          			</div>
          			<div class="widget-content nopadding">
            			<form class="form-horizontal" method="post" action="{{route('categories.edit',$category->id)}}" name="add_category" id="add_category">
            				@csrf
              				<div class="control-group">
                				<label class="control-label">Category Name</label>
                				<div class="controls">
                  					<input type="text" name="category_name" id="category_name" value="{{ $category->name }}">
                				</div>
              				</div>
                      <div class="control-group">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <textarea name="description" id="description">{{ $category->description }}</textarea>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Parent Category</label>
                        <div class="controls">
                          <select name="parent_id" id="parent_id" style="width: 25%">
                            <option value="0">Main Category</option>
                            @foreach($parent_category as $parent)
                              <option value="{{$parent->id}}" @if($category->parent_id == $parent->id) selected @endif>{{$parent->name}}</option>
                            @endforeach
                          </select>
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
