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
{{-- custom --}}
<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

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
                        <!--Profile Card 3-->
                                <div class="col-md-4 m-auto">
                                    <div class="card profile-card-3">
                                        <div class="background-block">
                                            <img src="https://images.pexels.com/photos/459225/pexels-photo-459225.jpeg?auto=compress&cs=tinysrgb&h=650&w=940" alt="profile-sample1" class="background"/>
                                        </div>
                                        <div class="profile-thumb-block">
                                            <img src="https://randomuser.me/api/portraits/men/41.jpg" alt="profile-image" class="profile"/>
                                        </div>
                                        <div class="card-content">
                                            <h2>{{ $data->name }}
                                              <a class="h6 text-info text-right position-absolute ml-2" href="{{ route('admin.users.edit', $data->id) }}">
                                                <span class="feather icon-edit-1"></span>
                                              </a>
                                              <small>{{ $data->role }}</small>
                                            </h2>
                                            <div class="icon-block"><a href="#"><i class="fab fa-facebook-f"></i></a><a href="#"> <i class="fab fa-twitter"></i></a><a href="#"> <i class="fab fa-google"></i></a></div>
                                            </div>
                                        </div>
                                </div>
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
