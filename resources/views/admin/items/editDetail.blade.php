<?php
{{-- dd($data->ingredients()->pluck('name')); --}}
?>

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

@section('title', 'Item')
@section('breadcrumb')
	<ul class="breadcrumb">
	    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
	    <li class="breadcrumb-item"><a href="{{ route('admin.items.index') }}">Item</a></li>
	    <li class="breadcrumb-item"><a href="javascript:">Add Item</a></li>
	</ul>
@endsection

@section('main-content')

  <!-- [ Main Content ] start -->
  <div class="row">
      <div class="col-sm-12">
          <div class="card">
              <div class="card-header">
                  <h5>Edit menu</h5>
                  <hr>
                  <div class="row">
                      <div class="col-lg-12">
                          <form action="{{ route('admin.items.updateDetail', $data->id) }}" method="post">
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
                                  <label for="data-price">Price</label>
                                  <input type="number" class="form-control" id="data-price" name="price" placeholder="Price" value="{{ old('price',$data->price) }}">
                              </div>


                              {{-- <div class="form-group">

                                <label for="data-category">Category</label>
                                <select class="form-control select-picker" id="data-category" name="category_id" data-style="btn-info">
                                  @foreach($categories as $category)
                                    <option
                                      value="{{ $category->id }}"
                                      {{ old('category_id', $data->category_id == $category->id ? 'selected' : '' ) }}
                                      >{{ $category->name }}</option>
                                  @endforeach
                                </select>

                              </div> --}}

                              <button class="btn btn-primary">Edit Menu Item</button>
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
