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

@section('title', 'Order')
@section('breadcrumb')
	<ul class="breadcrumb">
	    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
	    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Order</a></li>
	    <li class="breadcrumb-item"><a href="javascript:">Add Order</a></li>
	</ul>
@endsection

@section('main-content')

  <!-- [ Main Content ] start -->
  <div class="row">
      <div class="col-sm-12">
          <div class="card">
              <div class="card-header">
                  <h5>Detail Order</h5>
                  <hr>
                  <p class="h6 text-dark"><span class="font-weight-bold">Order By:</span> {{ $order->user->name }}</p>
                  <p class="text-dark"><span class="font-weight-bold">Date: </span>{{ date('l, d M Y', strtotime($order->created_at)) }}</p>
                  <div class="table-responsive">
                      <table class="table table-striped">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>Item</th>
                                  <th>Variant & Size</th>
                                  <th>Price</th>
                                  <th>Qty</th>
                                  <th>Subtotal</th>
                                  {{-- <th></th> --}}
                              </tr>
                          </thead>
                          <tbody>
                            @php $total = 0; $no = 1@endphp
                            @foreach($details as $detail)
                              <tr>
                                  <th scope="row">{{ $no++ }}</th>
                                  <td>{{ $detail->itemDetail->item->name }}</td>
                                  <td>{{ $detail->itemDetail->variant->name .', '. $detail->itemDetail->size->name}}</td>
                                  <td>Rp. {{ $price = $detail->itemDetail->price }}</td>
                                  <td>{{ $detail->qty }}</td>
                                  <td>Rp. {{ $st = $detail->qty * $price}}</td>
                                  {{-- <td><a href="{{ route('admin.items.index') }}"><i class="feather icon-edit"></i></a></td> --}}
                              </tr>
                              @php $total += $st @endphp
                              @endforeach
                              <tr style="border-top: 2px solid black">
                                <td></td>
                                <td colspan="4" class="font-weight-bold h5 text-dark">Total</td>
                                <td class="font-weight-bold h5 text-dark">Rp.{{ $total }}</td>
                                {{-- <td></td> --}}
                              </tr>
                          </tbody>
                      </table>
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
