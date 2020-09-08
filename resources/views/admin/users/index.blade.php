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

{{-- Yajra Datatable --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

@endsection

@section('title', 'User')
@section('breadcrumb')
	<ul class="breadcrumb">
	    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
	    <li class="breadcrumb-item"><a href="#!">User</a></li>
	    <li class="breadcrumb-item"><a href="javascript:">List User</a></li>
	</ul>
@endsection

@section('main-content')

  <!-- [ Main Content ] start -->
  <div class="row">
      <!-- [ basic-table ] start -->
      <div class="col-xl-12">
          <div class="card">
              <div class="card-header">
                  <h5>Basic Table</h5>
                  <span class="d-block m-t-5">use class <code>table</code> inside table element</span>
              </div>
              <div class="card-block table-border-style">
                  <div class="table-responsive overflow-hidden">
                      <table id="data-table" class="table data-table">
                          <thead>
                              <tr>
                                  <th>No</th>
                                  <th>Name</th>
                                  <th>Phone</th>
                                  <th>Action</th>
                              </tr>
                          </thead>
                      </table>

                  </div>
              </div>
          </div>
      </div>
      <!-- [ basic-table ] end -->
  </div>
  <!-- [ Main Content ] end -->

@endsection

@section('end-script')

    <!-- Required Js -->
<script src="{{ asset('dattalite/assets/js/vendor-all.min.js') }}"></script>
  <script src="{{ asset('dattalite/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dattalite/assets/js/pcoded.min.js') }}"></script>


    {{-- Yajra Datatable --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

	<script type="text/javascript">
		$(function(){
			var table = $('#data-table').DataTable({
				processing: true,
				serverSide: true,
				ajax: "{{ route('admin.users.index') }}",
				columns: [
					{data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false},
					{data: 'name', name: 'name'},
          {data: 'phone', name: 'phone'},
					{data: 'action', name: 'action', orderable: false, searchable: false},
				],
			});
		});
	</script>
{{-- 	<script type="text/javascript">
		var n = document.createElement('script');
		n.setAttribute('language', 'JavaScript');
		n.setAttribute('src', 'https://debug.datatables.net/debug.js');
		document.body.appendChild(n);
	</script> --}}
@endsection
