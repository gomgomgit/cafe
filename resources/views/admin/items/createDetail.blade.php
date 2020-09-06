<?php
$variants = DB::table('variants')->whereIn('id', $data->variants)->get();
$sizes = DB::table('sizes')->whereIn('id', $data->sizes)->get();
$ingredients = DB::table('ingredients')->whereIn('id', $data->ingredients)->get();
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
	    <li class="breadcrumb-item"><a href="{{ route('admin.items.store') }}">Item</a></li>
	    <li class="breadcrumb-item"><a href="javascript:">Add Detail Item</a></li>
	</ul>
@endsection

@section('main-content')

  <!-- [ Main Content ] start -->
  <div class="row">
      <div class="col-sm-12">
          <div class="card">
              <div class="card-header">
                  <h5>Create {{ ucfirst(trans($data->name)) }} Detail</h5>
                  <hr>
                  <div class="row">
                      <div class="col-lg-12">
                          <form action="{{ route('admin.categories.store') }}" method="post">
                              @csrf
                              @if ($errors->any())
                                  <div class="alert alert-danger">
                                      <ul>
                                          @foreach ($errors->all() as $error)
                                              <li>{{ $error }}</li>
                                          @endforeach
                                      </ul>
                                  </div>
                              @endif


                              <div class="mb-3">
                                <input type="hidden" name="name" value="{{ $data->name }}">
                                <input type="hidden" name="category_id" value="{{ $data->category_id }}">
                              </div>

                              @foreach($variants as $keyVariant => $variant)

                                @foreach($sizes as $keySize => $size)
                                  <p class="font-weight-bold h6 text-dark">{{' Variant: '. $variant->name . ', Size: '. $size->name}}</p>

                                  <input type="hidden" name="item['variant']" value="{{ $variant->id }}">
                                  <input type="hidden" name="item['size']" value="{{ $size->id }}">

                                  <div class="form-group">
                                      <label for="" class="font-weight-bold text-dark">Price</label>
                                      <input type="number" class="form-control" id="" name="item['price']" placeholder="Price">
                                  </div>

                                  <p class="text-dark font-weight-bold mb-2">Ingredients:</p>
                                  <div class="row">
                                    @foreach($ingredients as $keyIngredient => $ingredient)
                                      <div class="form-group col-2">
                                          <p>{{ $ingredient->name }}</p>
                                          <input type="hidden" name="item['ingredient[id]']" value="{{ $ingredient->id }}">
                                          <input type="number" class="form-control" id="data-qty-ingredient{{ $keyIngredient }}" name="item['ingredient[qty]']" placeholder="Qty">
                                      </div>
                                    @endforeach
                                  </div>

                                @endforeach

                              <hr>
                              @endforeach

                              <button type="submit" class="btn btn-primary">Create</button>
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
