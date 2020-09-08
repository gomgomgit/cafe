<?php
$variants = $dbVariant->whereIn('id', $data->variants)->get();
$sizes = $dbSize->whereIn('id', $data->sizes)->get();
$ingredients = $dbIngredient->whereIn('id', $data->ingredients)->get();
$ingredientSelected = count($ingredients);
$ingredientCount = 0;
$detailCount = 0;

use App\Model\ItemDetail;

function searchDetail($variant, $size)
{
    return ItemDetail::where([['variant_id', $variant], ['size_id', $size]])->first();
}
function ingredientDetail($detail, $ingredient)
{
    if ($detail) {
        $data = $detail->ingredients()->pluck('amount_ingredient', 'ingredients.id')->toArray();
        return $data;
    }
}

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
                          <form action="{{ route('admin.items.updateDetailOption', $data->id) }}" method="post">
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


                              <div class="mb-3">
                                <input type="hidden" re="test" name="name" value="{{ $data->name }}">
                                <input type="hidden" re="test" name="category_id" value="{{ $data->category_id }}">
                              </div>

                              @foreach($variants as $key => $variant)

                                @foreach($sizes as $key => $size)
                                  @php
                                  $detailCount++;
                                  // dd(searchPrice($variant->id, $size->id));
                                  $detailData = searchDetail($variant->id, $size->id);
                                  @endphp
                                  <p class="font-weight-bold h6 text-dark">{{$detailCount . '. Variant: '. $variant->name . ', Size: '. $size->name}}</p>

                                  <input type="hidden" re="test" name="variant[]" value="{{ $variant->id }}">
                                  <input type="hidden" re="test" name="size[]" value="{{ $size->id }}">

                                  <div class="form-group">
                                      <label for="" class="font-weight-bold text-dark">Price</label>
                                      <input type="number" class="form-control" id="" name="price[]" placeholder="Price" value="{{ $detailData ? $detailData->price : '' }}">
                                  </div>

                                  <p class="text-dark font-weight-bold mb-2">Ingredients:</p>
                                  <div class="row">
                                    @foreach($ingredients as $keyIngredient => $ingredient)
                                    @php
                                      $ingredientCount++;

                                      $ingredientDetail = ingredientDetail($detailData, $ingredient);

                                    @endphp
                                      <div class="form-group col-2">
                                          <p>{{ $ingredient->name }}</p>
                                          <input type="hidden" re="test" name="ingredientId[]" value="{{ $ingredient->id }}">
                                          <input type="number" class="form-control" id="data-qty-ingredient{{ $keyIngredient }}" name="ingredientQty[]"
                                            value="{{ $ingredientDetail[$ingredient->id] ? $ingredientDetail[$ingredient->id] : '' }}"
                                            placeholder="Qty">
                                      </div>
                                    @endforeach
                                  </div>

                                @endforeach

                              <hr>
                              @endforeach
                              <input type="hidden" re="test" name="detailCount" value="{{ $detailCount }}">
                              <input type="hidden" re="test" name="ingredientSelected" value="{{ $ingredientSelected }}">
                              <input type="hidden" re="test" name="ingredientCount" value="{{ $ingredientCount }}">

                              {{-- <div class="form-group">
                                  <label for="inputImage" class="text-dark font-weight-bold mb-2">Image</label>
                                  <input class="d-block" id="inputImage" type="file" placeholder="Title" name="image_file" accept="image/*">
                              </div>

                              <div class="form-group">
                                  <label for="description" class="text-dark font-weight-bold mb-2">Description</label>
                                  <textarea class="form-control" id="description" rows="3">{{ $item->description }}</textarea>
                              </div> --}}

                              <button type="submit" class="btn btn-primary">Edit</button>
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
