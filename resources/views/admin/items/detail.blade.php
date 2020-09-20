<?php
$no = 0;
$variants = [];
$sizes = [];
foreach ($details as $key => $detail) {
    if (!in_array($detail->variant->name, $variants)) {
        array_push($variants, $detail->variant->name);
    }
    if (!in_array($detail->size->name, $sizes)) {
        array_push($sizes, $detail->size->name);
    }
}
$ingredients = $detail->first()->ingredients()->pluck('name');
$item = App\Model\Item::find($data->id);
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
                  <h5>Detail Item</h5>
                  <hr>
                  <div class="row">
                      <div class="col-lg-12">

                        <div class="cardcus my-5">
                          {{-- <div class="img-avatar">
                          </div> --}}
                          <div class="cardcus-text">
                            <div class="portada"
                              style="background-image: url({{ asset('image/'.$data->image) }});"
                            >

                            </div>
                            <div class="title-total">
                              <div class="title">{{ $data->category->name }}</div>
                              <h2>{{ $data->name }}
                                @can('update', $data)
                                  <a class="h5 text-info text-right" href="{{ route('admin.items.editItem', $data->id) }}"><i class="feather icon-edit-1"></i></a>
                                @endcan
                              </h2>

                              <div class="desc">{{ $data->description }}</div>

                              <div class="type desc">

                                <p class="font-weight-bold text-lg text-dark m-0 mb-2">Variant :</p>

                                @foreach($variants as $variant)
                                <span class="tp"> {{ $variant }},</span>
                                @endforeach
                              </div>
                              <div class="type desc">

                                <p class="font-weight-bold text-lg text-dark m-0 mb-2">Size :</p>

                                @foreach($sizes as $size)
                                <span class="tp"> {{ ($size) }},</span>
                                @endforeach
                              </div>
                              <div class="type desc">

                                <p class="font-weight-bold text-lg text-dark m-0 mb-2">Ingredients :</p>

                                @foreach($ingredients as $ingredient)
                                <span class="tp"> {{ ($ingredient) }},</span>
                                @endforeach
                              </div>

                              {{-- <div class="actions">
                                <button><i class="far fa-heart"></i></button>
                                <button><i class="far fa-envelope"></i></button>
                                <button><i class="fas fa-user-friends"></i></button>
                              </div> --}}
                            </div>

                          </div>



                        </div>

                        <div class="cardcus my-5">
                          {{-- <div class="img-avatar">
                          </div> --}}
                          <div class="cardcus-text-b">
                            <div class="title-total">
                              {{-- <div class="title">{{ $data->category->name }}</div> --}}
                              <h2>Menu Option</h2>

                              <div class="type desc">

                                @foreach($details as $detail)
                                @php $no++ @endphp
                                <p class="price-list"> {{ $no .'. '.
                                  ($detail->variant->id == 1 ? '' : $detail->variant->name) .' ' .$data->name.' '.
                                  ($detail->size->id == 1 ? '' : ' Size: '. $detail->size->name) .': Rp.'.$detail->price}}

                                  @can('update', $data)
                                    <a class=" text-info text-right" href="{{ route('admin.items.editDetail', $detail->id) }}"><i class="feather icon-edit-1"></i></a>
                                  @endcan
                                </p>
                                @endforeach


                                @can('update', $data)
                                <hr>

                                <a class="btn btn-info" href="{{ route('admin.items.editOption', $data->id) }}">Edit Menu Option</a>
                                @endcan
                              </div>

                              {{-- <div class="actions">
                                <button><i class="far fa-heart"></i></button>
                                <button><i class="far fa-envelope"></i></button>
                                <button><i class="fas fa-user-friends"></i></button>
                              </div> --}}

                            </div>


                            <div class="portada portada-b"
                              style="background-image: url({{ asset('image/'.$data->image) }});"
                            >

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
