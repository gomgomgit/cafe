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
$month = Carbon\Carbon::now()->format('m');
$totalIncome = App\Model\Order::pluck('total')->sum();
$yearIncome = App\Model\Order::whereYear('created_at', $year)->pluck('total')->sum();
$monthIncome = App\Model\Order::whereMonth('created_at', $month)->pluck('total')->sum();
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
                                                <h3 class="f-w-300 d-flex align-items-center m-b-0"><i class="feather icon-arrow-up text-c-green f-30 m-r-10"></i>Rp.{{ $monthIncome }}</h3>
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
                                                <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i class="feather icon-arrow-down text-c-red f-30 m-r-10"></i>Rp.{{ $yearIncome }}</h3>
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
                                                <h3 class="f-w-300 d-flex align-items-center  m-b-0"><i class="feather icon-arrow-up text-c-green f-30 m-r-10"></i>Rp.{{ $totalIncome }}</h3>
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
                                                        <td>Total: &nbsp; Rp.{{ $order->total }}</td>
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
                            <div class="col-md-12 col-xl-4">
                                <div class="card card-social">
                                    <div class="card-block border-bottom">
                                        <div class="row align-items-center justify-content-center">
                                            <div class="col-auto">
                                                <i class="fab fa-facebook-f text-primary f-36"></i>
                                            </div>
                                            <div class="col text-right">
                                                <h3>12,281</h3>
                                                <h5 class="text-c-green mb-0">+7.2% <span class="text-muted">Total Likes</span></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="row align-items-center justify-content-center card-active">
                                            <div class="col-6">
                                                <h6 class="text-center m-b-10"><span class="text-muted m-r-5">Target:</span>35,098</h6>
                                                <div class="progress">
                                                    <div class="progress-bar progress-c-theme" role="progressbar" style="width:60%;height:6px;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="text-center  m-b-10"><span class="text-muted m-r-5">Duration:</span>3,539</h6>
                                                <div class="progress">
                                                    <div class="progress-bar progress-c-theme2" role="progressbar" style="width:45%;height:6px;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-social">
                                    <div class="card-block border-bottom">
                                        <div class="row align-items-center justify-content-center">
                                            <div class="col-auto">
                                                <i class="fab fa-facebook-f text-primary f-36"></i>
                                            </div>
                                            <div class="col text-right">
                                                <h3>12,281</h3>
                                                <h5 class="text-c-green mb-0">+7.2% <span class="text-muted">Total Likes</span></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="row align-items-center justify-content-center card-active">
                                            <div class="col-6">
                                                <h6 class="text-center m-b-10"><span class="text-muted m-r-5">Target:</span>35,098</h6>
                                                <div class="progress">
                                                    <div class="progress-bar progress-c-theme" role="progressbar" style="width:60%;height:6px;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="text-center  m-b-10"><span class="text-muted m-r-5">Duration:</span>3,539</h6>
                                                <div class="progress">
                                                    <div class="progress-bar progress-c-theme2" role="progressbar" style="width:45%;height:6px;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-xl-8">

                              <div class="card">
                                  <div class="card-header">
                                      <h5>Sale Chart</h5>
                                  </div>
                                  <div class="card-block">
                                      <canvas id="myChart" width="100"></canvas>

                                  </div>
                              </div>

                            </div>
                            <!--[social-media section] end-->
                            <!-- [ rating list ] starts-->
                            {{-- <div class="col-xl-4 col-md-6">
                                <div class="card user-list">
                                    <div class="card-header">
                                        <h5>Rating</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="row align-items-center justify-content-center m-b-20">
                                            <div class="col-6">
                                                <h2 class="f-w-300 d-flex align-items-center float-left m-0">4.7 <i class="fas fa-star f-10 m-l-10 text-c-yellow"></i></h2>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="d-flex  align-items-center float-right m-0">0.4 <i class="fas fa-caret-up text-c-green f-22 m-l-10"></i></h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xl-12">
                                                <h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>5</h6>
                                                <h6 class="align-items-center float-right">384</h6>
                                                <div class="progress m-t-30 m-b-20" style="height: 6px;">
                                                    <div class="progress-bar progress-c-theme" role="progressbar" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>4</h6>
                                                <h6 class="align-items-center float-right">145</h6>
                                                <div class="progress m-t-30  m-b-20" style="height: 6px;">
                                                    <div class="progress-bar progress-c-theme" role="progressbar" style="width: 35%;" aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>3</h6>
                                                <h6 class="align-items-center float-right">24</h6>
                                                <div class="progress m-t-30  m-b-20" style="height: 6px;">
                                                    <div class="progress-bar progress-c-theme" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>2</h6>
                                                <h6 class="align-items-center float-right">1</h6>
                                                <div class="progress m-t-30  m-b-20" style="height: 6px;">
                                                    <div class="progress-bar progress-c-theme" role="progressbar" style="width: 10%;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-12">
                                                <h6 class="align-items-center float-left"><i class="fas fa-star f-10 m-r-10 text-c-yellow"></i>1</h6>
                                                <h6 class="align-items-center float-right">0</h6>
                                                <div class="progress m-t-30  m-b-20" style="height: 6px;">
                                                    <div class="progress-bar" role="progressbar" style="width:0;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- [ rating list ] end-->
                            {{-- <div class="col-xl-8 col-md-12 m-b-30">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Today</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active show" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">This Week</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">All</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Activity</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th class="text-right"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h6 class="m-0"><img class="rounded-circle m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">The quick brown fox</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">3:28 PM</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0 text-c-green">Done</h6>
                                                    </td>
                                                    <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-2.jpg" alt="activity-user">Albert Andersen</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">Jumps over the lazy</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">2:37 PM</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0 text-c-red">Missed</h6>
                                                    </td>
                                                    <td class="text-right"><i class="fas fa-circle text-c-red f-10"></i></td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-3.jpg" alt="activity-user">Silje Larsen</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">Dog the quick brown</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">10:23 AM</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0 text-c-purple">Delayed</h6>
                                                    </td>
                                                    <td class="text-right"><i class="fas fa-circle text-c-purple f-10"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">The quick brown fox</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">4:28 PM</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0 text-c-green">Done</h6>
                                                    </td>
                                                    <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="tab-pane fade active show" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Activity</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th class="text-right"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-2.jpg" alt="activity-user">Albert Andersen</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">Jumps over the lazy</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">2:37 PM</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0 text-c-red">Missed</h6>
                                                    </td>
                                                    <td class="text-right"><i class="fas fa-circle text-c-red f-10"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="m-0"><img class="rounded-circle m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">The quick brown fox</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">3:28 PM</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0 text-c-green">Done</h6>
                                                    </td>
                                                    <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">The quick brown fox</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">4:28 PM</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0 text-c-green">Done</h6>
                                                    </td>
                                                    <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-3.jpg" alt="activity-user">Silje Larsen</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">Dog the quick brown</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">10:23 AM</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0 text-c-purple">Delayed</h6>
                                                    </td>
                                                    <td class="text-right"><i class="fas fa-circle text-c-purple f-10"></i></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>User</th>
                                                    <th>Activity</th>
                                                    <th>Time</th>
                                                    <th>Status</th>
                                                    <th class="text-right"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-3.jpg" alt="activity-user">Silje Larsen</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">Dog the quick brown</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">10:23 AM</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0 text-c-purple">Delayed</h6>
                                                    </td>
                                                    <td class="text-right"><i class="fas fa-circle text-c-purple f-10"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="m-0"><img class="rounded-circle m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">The quick brown fox</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">3:28 PM</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0 text-c-green">Done</h6>
                                                    </td>
                                                    <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-2.jpg" alt="activity-user">Albert Andersen</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">Jumps over the lazy</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">2:37 PM</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0 text-c-red">Missed</h6>
                                                    </td>
                                                    <td class="text-right"><i class="fas fa-circle text-c-red f-10"></i></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h6 class="m-0"><img class="rounded-circle  m-r-10" style="width:40px;" src="assets/images/user/avatar-1.jpg" alt="activity-user">Ida Jorgensen</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">The quick brown fox</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0">4:28 PM</h6>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-0 text-c-green">Done</h6>
                                                    </td>
                                                    <td class="text-right"><i class="fas fa-circle text-c-green f-10"></i></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> --}}

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
                  borderColor: '#4A1B03',
                  borderWidth: 5
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
