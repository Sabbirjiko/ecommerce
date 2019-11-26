@extends('layouts.admin_layouts.admin_main')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ route('admin_dashboard') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="{{route('admin_settings')}}" title="Settings" class="current tip-bottom">Settings</a> </div>
    <h1>Admin Settings</h1>
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
  <div class="container-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Update password</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{route('admin.update_pass') }}" name="password_validate" id="password_validate" novalidate="novalidate">
                @csrf
                <div class="control-group">
                  <label class="control-label">Current Password</label>
                  <div class="controls">
                    <input type="password" name="current_pwd" id="current_pwd" /><span id="pwd_info"></span>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">New Password</label>
                  <div class="controls">
                    <input type="password" name="new_pwd" id="new_pwd" />
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Confirm password</label>
                  <div class="controls">
                    <input type="password" name="confirm_pwd" id="confirm_pwd" />
                  </div>
                </div>
                <div class="form-actions">
                  <input type="submit" value="Update Password" class="btn btn-success">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

@endsection
