@extends('admin.layouts.app')

@section('head-script')

<!-- Favicon icon -->
<link rel="icon" href="{{ asset('dattalite/assets/images/favicon.ico') }}" type="image/x-icon">
<!-- fontawesome icon -->
<link rel="stylesheet" href="{{ asset('dattalite/assets/fonts/fontawesome/css/fontawesome-all.min.css') }}">
<!-- animation css -->
<link rel="stylesheet" href="{{ asset('dattalite/assets/plugins/animation/css/animate.min.css') }}">
<!-- vendor css -->
<link rel="stylesheet" href="{{ asset('dattalite/assets/css/style.css') }}">

@endsection

@section('title', 'User')
@section('breadcrumb')
	<ul class="breadcrumb">
	    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
	    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">User</a></li>
	    <li class="breadcrumb-item"><a href="javascript:">Add User</a></li>
	</ul>
@endsection

@section('main-content')

  <!-- [ Main Content ] start -->
  <div class="row">
      <div class="col-sm-12">
          <div class="card">
              <div class="card-header">
                  <h5>Edit User</h5>
                  <hr>
                  <div class="row">
                      <div class="col-lg-12">
                          <form action="{{ route('admin.users.update', $data->id) }}" method="post">
                              @csrf
                              @method('PUT')
                              @if ($errors->any())
                                  <div class="alert alert-danger">
                                      <ul>
                                          @foreach ($errors->all() as $error)
                                              <li>{{ $error }}</li>
                                          @endforeach
                                      </ul>
                                  </div>
                              @endif
                              <div class="form-group">
                                  <label for="data-name">Name</label>
                                  <input type="text" class="form-control" id="data-name" name="name" placeholder="User Name" value="{{ old('name', $data->name) }}">
                              </div>
                              <div class="form-group">
                                  <label for="data-password">Password</label>
                                  <input type="password" class="form-control" id="data-password" name="password" placeholder="User password">
                              </div>

                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="roleadmin" name="role" class="custom-control-input" value="admin" {{ $data->role == 'admin' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="roleadmin">Admin</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="roleope" name="role" class="custom-control-input" value="operator" {{ $data->role == 'operator' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="roleope">Operator</label>
                              </div>
                              <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" id="roleemplo" name="role" class="custom-control-input" value="employee" {{ $data->role == 'employee' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="roleemplo">Employee</label>
                              </div>

                              <div class="form-group">
                                  <label for="data-phone">Phone</label>
                                  <input type="text" class="form-control" id="data-phone" name="phone" placeholder="User phone">
                              </div>

                              <button type="submit" class="btn btn-primary"><i class="feather icon-plus"></i>Update</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- [ Main Content ] end -->

@endsection

@section('end-script')

    <!-- Required Js -->
<script src="{{ asset('dattalite/assets/js/vendor-all.min.js') }}"></script>
  <script src="{{ asset('dattalite/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dattalite/assets/js/pcoded.min.js') }}"></script>

@endsection
