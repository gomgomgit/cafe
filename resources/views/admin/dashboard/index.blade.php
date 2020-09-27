<?php
$latestUsers = App\Model\User::latest()->take(5)->get();
$lastOrder = App\Model\Order::latest()->take(5)->get();
$categoryCount = App\Model\Category::count();
$itemCount = App\Model\Item::count();

$cardCounts = [
    [
        'name' => 'USER',
        'count' => App\Model\User::count(),
        'icon' => 'user',
    ],
    [
        'name' => 'CATEGORY',
        'count' => App\Model\Category::count(),
        'icon' => 'bookmark',
    ],
    [
        'name' => 'ITEM',
        'count' => App\Model\Item::count(),
        'icon' => 'box',
    ],
    [
        'name' => 'ITEM ORDERED',
        'count' => $items->pluck('ordered')->collapse()->sum('qty'),
        'icon' => 'shopping-cart',
    ],
];

$year = Carbon\Carbon::now()->format('Y');
$lyear = Carbon\Carbon::now()->subYear()->format('Y');
$month = Carbon\Carbon::now()->format('m');
$lmonth = Carbon\Carbon::now()->subMonth()->format('m');
$totalIncome = App\Model\Order::pluck('total')->sum();
$yearIncome = App\Model\Order::whereYear('created_at', $year)->pluck('total')->sum();
$lyearIncome = App\Model\Order::whereYear('created_at', $lyear)->pluck('total')->sum();
$monthIncome = App\Model\Order::whereMonth('created_at', $month)->pluck('total')->sum();
$lmonthIncome = App\Model\Order::whereMonth('created_at', $lmonth)->pluck('total')->sum();
{{-- dd($yearIncome); --}}
{{-- dd($month); --}}
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

@endsection

@section('main-content')

                        <!-- [ Main Content ] start -->
                        <div class="row">
                            <!--[ daily sales section ] start-->
                            <div class="col-md-6 col-xl-4">
                                <div class="card daily-sales">
                                    <div class="card-block">
                                        <h6 class="mb-4">Month Sales</h6>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0">
                                                    @if($lmonthIncome < $monthIncome)
                                                        <i class="feather icon-arrow-up text-c-green f-30 m-r-10"></i>
                                                    @else
                                                        <i class="feather icon-arrow-down text-c-red f-30 m-r-10"></i>
                                                    @endif
                                                    Rp {{ number_format($monthIncome,2,",",".") }}
                                                </h3>
                                            </div>

                                            <div class="col-3 text-right">
                                                <p class="m-b-0">67%</p>
                                            </div>
                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--[ daily sales section ] end-->
                            <!--[ Monthly  sales section ] starts-->
                            <div class="col-md-6 col-xl-4">
                                <div class="card Monthly-sales">
                                    <div class="card-block">
                                        <h6 class="mb-4">Year Sales</h6>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center  m-b-0">
                                                    
                                                    @if($lyearIncome < $yearIncome)
                                                        <i class="feather icon-arrow-up text-c-green f-30 m-r-10"></i>
                                                    @else
                                                        <i class="feather icon-arrow-down text-c-red f-30 m-r-10"></i>
                                                    @endif

                                                    Rp {{ number_format($yearIncome,2,",",".") }}</h3>
                                            </div>
                                            <div class="col-3 text-right">
                                                <p class="m-b-0">36%</p>
                                            </div>
                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme2" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--[ Monthly  sales section ] end-->
                            <!--[ year  sales section ] starts-->
                            <div class="col-md-12 col-xl-4">
                                <div class="card yearly-sales">
                                    <div class="card-block">
                                        <h6 class="mb-4">Total Income</h6>
                                        <div class="row d-flex align-items-center">
                                            <div class="col-9">
                                                <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i class="feather icon-arrow-up text-c-green f-30 m-r-10"></i>Rp {{ number_format($totalIncome,2,",",".") }}</h3>
                                            </div>
                                            <div class="col-3 text-right">
                                                <p class="m-b-0">80%</p>
                                            </div>
                                        </div>
                                        <div class="progress m-t-30" style="height: 7px;">
                                            <div class="progress-bar progress-c-theme" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--[ year  sales section ] end-->
                            <!--[ Recent Users ] start-->
                            <div class="col-xl-8 col-md-6">
                                <div class="card Recent-Users">
                                    <div class="card-header">
                                        <h5>Lastest Order</h5>
                                    </div>
                                    <div class="card-block px-0 py-3">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <tbody>

                                                  @foreach($lastOrder as $order)
                                                    <tr class="unread">
                                                        <td>
                                                            <h6 class="mb-1">{{ $order->customer }}</h6>
                                                            <p class="m-0"></p>
                                                        </td>
                                                        <td>
                                                            <h6 class="text-muted"><i class="fas fa-circle text-c-green f-10 m-r-15"></i>
                                                                {{ date('l, d-M-Y', strtotime($order->created_at))}}
                                                            </h6>
                                                        </td>
                                                        <td>Total: &nbsp; Rp {{ $order->total }}</td>
                                                        {{-- <td><a href="#!" class="label theme-bg2 text-white f-12">Reject</a><a href="#!" class="label theme-bg text-white f-12">Approve</a></td> --}}
                                                    </tr>
                                                  @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--[ Recent Users ] end-->

                            <!-- [ statistics year chart ] start -->
                            <div class="col-xl-4 col-md-6">
                                {{-- <div class="card card-event">
                                    <div class="card-block">
                                        <div class="row align-items-center justify-content-center">
                                            <div class="col">
                                                <h5 class="m-0">Upcoming Event</h5>
                                            </div>
                                            <div class="col-auto">
                                                <label class="label theme-bg2 text-white f-14 f-w-400 float-right">34%</label>
                                            </div>
                                        </div>
                                        <h2 class="mt-3 f-w-300">45<sub class="text-muted f-14">Competitors</sub></h2>
                                        <h6 class="text-muted mt-4 mb-0">You can participate in event </h6>
                                        <i class="fab fa-angellist text-c-purple f-50"></i>
                                    </div>
                                </div> --}}
                                <div class="card">

                                  @foreach($cardCounts as $cardCount)
                                    <div class="card-block border-bottom">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-auto">
                                                <i class="feather icon-{{ $cardCount['icon'] }} f-40 text-c-green"></i>
                                            </div>
                                            <div class="col">
                                                <h3 class="f-w-300">{{ $cardCount['count'] }}</h3>
                                                <span class="d-block text-uppercase">TOTAL {{ $cardCount['name'] }}</span>
                                            </div>
                                        </div>
                                    </div>
                                  @endforeach

                                </div>
                            </div>
                            <!-- [ statistics year chart ] end -->
                            <!--[social-media section] start-->
                            <div class="col-md-12 col-xl-12">

                              <div class="card">
                                  <div class="card-header">
                                      <h5>Sale Chart</h5>
                                  </div>
                                  <div class="card-block">
                                      <canvas id="myChart" width="100"></canvas>

                                  </div>
                              </div>

                            </div>
                            

                        </div>
                        <!-- [ Main Content ] end -->
                    </div>
@endsection

@section('end-script')

    <!-- Required Js -->
<script src="{{ asset('dattalite/assets/js/vendor-all.min.js') }}"></script>
  <script src="{{ asset('dattalite/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dattalite/assets/js/pcoded.min.js') }}"></script>

    {{-- ChartJs --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<script type="text/javascript">
  var ctx = document.getElementById('myChart');
  var myChart = new Chart(ctx, {
      type: 'bar',
          data: {
              labels: @json($itemName),
              datasets: [{
                  label: 'Ordered',
                  data: @json($itemOrdered),
                  backgroundColor: '#6A2B05',
                  // borderColor: '#4A1B03',
                  // borderWidth: 5
              }]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      }
                  }]
              }
          }
  });
</script>

@endsection
