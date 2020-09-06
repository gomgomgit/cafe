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
                  <h5>Create Item</h5>
                  <hr>
                  <div class="row">
                      <div class="col-lg-12">
                          <form action="{{ route('admin.items.createDetail') }}" method="post">
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
                              <div class="form-group">
                                  <label for="data-name">Name</label>
                                  <input type="text" class="form-control" id="data-name" name="name" placeholder="Item Name" value="{{ old('name') }}">
                              </div>


                              <div class="form-group">

                                <label for="data-category">Category</label>
                                <select class="form-control select-picker" id="data-category" name="category_id" data-style="btn-info">
                                  @foreach($categories as $category)
                                    <option
                                      value="{{ $category->id }}"
                                      {{ old('category_id') == $category->id ? 'selected' : '' }}
                                      >{{ $category->name }}</option>
                                  @endforeach
                                </select>

                              </div>


                              <div class="form-group">
                                <div class="custom-body">
                                  <div class="custom-container d-flex">
                                    <p>Variant</p>
                                    <ul class="ks-cboxtags">

                                      @foreach($variants as $key => $variant)
                                        <li><input type="checkbox" name="variants[]" id="variant{{ $key }}"
                                        value="{{ $variant->id }}"
                                        @if(is_array(old('variants')) && in_array($variant->id, old('variants'))) checked @endif
                                        ><label for="variant{{ $key }}">{{ $variant->name }}</label></li>
                                      @endforeach

                                    </ul>

                                  </div>

                                </div>
                              </div>

                              <div class="form-group">
                                <div class="custom-body">
                                  <div class="custom-container d-flex">
                                    <p>Size</p>
                                    <ul class="ks-cboxtags">

                                      @foreach($sizes as $key => $size)
                                        <li><input type="checkbox" name="sizes[]" id="size{{ $key }}" value="{{ $size->id }}" {{ old('sizes')?'checked':'' }}><label for="size{{ $key }}">{{ $size->name }}</label></li>
                                      @endforeach

                                    </ul>

                                  </div>

                                </div>
                              </div>

                              <div class="form-group">
                                <div class="custom-body">
                                  <div class="custom-container d-flex">
                                    <p>Ingredient</p>
                                    <ul class="ks-cboxtags">

                                      @foreach($ingredients as $key => $ingredient)
                                        <li><input type="checkbox" name="ingredients[]" id="ingredient{{ $key }}" value="{{ $ingredient->id }}"><label for="ingredient{{ $key }}">{{ $ingredient->name }}</label></li>
                                      @endforeach

                                    </ul>

                                  </div>

                                </div>
                              </div>

                              <div class="form-group">
                                  <label for="inputImage">Image</label>
                                  <input class="d-block" id="inputImage" type="file" placeholder="Title" name="image_file" accept="image/*">
                              </div>

                              <div class="form-group">
                                  <label for="description">Description</label>
                                  <textarea class="form-control" id="description" rows="3"></textarea>
                              </div>

                              <button class="btn btn-primary">Next</button>
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
