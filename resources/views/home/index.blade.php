<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
    <title>KapeSop</title>

	<!--
            CSS
            ============================================= -->
	<link rel="stylesheet" href="{{asset('karma/css/linearicons.css')}}">
	<link rel="stylesheet" href="{{asset('karma/css/owl.carousel.css')}}">
	<link rel="stylesheet" href="{{asset('karma/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('karma/css/themify-icons.css')}}">
	<link rel="stylesheet" href="{{asset('karma/css/nice-select.css')}}">
	<link rel="stylesheet" href="{{asset('karma/css/nouislider.min.css')}}">
	<link rel="stylesheet" href="{{asset('karma/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('karma/css/main.css')}}">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/itemshop.css') }}">

	<style type="text/css">
		.overlay {
			position: absolute;
			top: 0; bottom: 0; right: 0; left: 0;
			background: rgba(0,0,0,0.4);
			display: none;
		}
		.overlay-t:hover .overlay , .overlay-t:hover .addtocart {
			display: block;
		}
		.addtocart:hover a {
			color: salmon;
		}
		.addtocart a {
			color: black;
		}
		.addtocart {
			position: absolute;
			top: 50%; left: 50%;
			transform: translate(-50%, -50%);
			cursor: pointer;
			border-radius: 100px ;
			display: none;
			font-size: 14px;
		}
	</style>
</head>

<body id="category">
	<div class="ordermes">
		<div>
			<p class="ordercustomer">{{ session('customer') }}</p>
			<p class="order">{{ session('order') }}</p>
			<p class="mess">Mohon Tunggu di Ruang Tunggu</p>
		</div>
	</div>

	<!-- Start Header Area -->
	{{-- <header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="index.html"><img src="img/logo.png" alt=""></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
							<li class="nav-item submenu dropdown active">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Shop</a>
								<ul class="dropdown-menu">
									<li class="nav-item active"><a class="nav-link" href="category.html">Shop Category</a></li>
									<li class="nav-item"><a class="nav-link" href="single-product.html">Product Details</a></li>
									<li class="nav-item"><a class="nav-link" href="checkout.html">Product Checkout</a></li>
									<li class="nav-item"><a class="nav-link" href="cart.html">Shopping Cart</a></li>
									<li class="nav-item"><a class="nav-link" href="confirmation.html">Confirmation</a></li>
								</ul>
							</li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Blog</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
									<li class="nav-item"><a class="nav-link" href="single-blog.html">Blog Details</a></li>
								</ul>
							</li>
							<li class="nav-item submenu dropdown">
								<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
								 aria-expanded="false">Pages</a>
								<ul class="dropdown-menu">
									<li class="nav-item"><a class="nav-link" href="login.html">Login</a></li>
									<li class="nav-item"><a class="nav-link" href="tracking.html">Tracking</a></li>
									<li class="nav-item"><a class="nav-link" href="elements.html">Elements</a></li>
								</ul>
							</li>
							<li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="nav-item"><a href="#" class="cart"><span class="ti-bag"></span></a></li>
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between">
					<input type="text" class="form-control" id="search_input" placeholder="Search Here">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header> --}}
	<!-- End Header Area -->

	<!-- Start Banner Area -->
	{{-- <section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Shop Category page</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Fashon Category</a>
					</nav>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- End Banner Area -->
	<div class="container" x-data="shoppine()">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5 pt-5">
				<div class="sidebar-categories mt-5">
					<div class="py-3 mb-1 text-white font-weight-bold pl-2">Categories</div>
					<ul class="">
						{{-- @foreach($categories as $category)
							<li class="main-nav-list">
								<a href="#">{{ $category->name }}<span class="number">{{ $category->itemCount() }}</span></a>
							</li>
						@endforeach --}}
						<template x-for="category in categories" :key="category">
							<li class="main-nav-list">
								<a class="text-white font-weight-bold lcategory" :href="'/category/'+category.id"><span class="nlcate" x-text="category.name"></span>
									<span class="number"> (<span x-text="category.items_count"></span>)</span>
								</a>
							</li>
						</template>
					</ul>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7 py-4">
				<!-- Start Filter Bar -->
				<div class="d-flex justify-between">
					<h2 class="text-light font-weight-bold w-50 align-items-center py-4 ml-4">Kapesop</h2>

					<div class="search-bar">
						<input type="text" name="search" pattern=".*\S.*" x-model="search" required>
						<button class="search-btn" type="submit">
							<span>Search</span>
						</button>
					</div>
					{{-- <div class="sorting">
						<select>
							<option value="1">Default sorting</option>
							<option value="1">Default sorting</option>
							<option value="1">Default sorting</option>
						</select>
					</div>
					<div class="sorting mr-auto">
						<select>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
						</select>
					</div>
					<div class="pagination">
						<a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
						<a href="#" class="active">1</a>
						<a href="#">2</a>
						<a href="#">3</a>
						<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
						<a href="#">6</a>
						<a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div> --}}
				</div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row">
						<template x-for="item in filteredItems" :key="item">
							<!-- single product -->
							<div class="col-lg-4 col-md-6">
								<div class="single-product position-relative mb-0 overlay-t">
									<img class="img-fluid m-0" :src="'/image/' + item.image" alt="">
									<div class="overlay"></div>
									<div class="product-details position-absolute"
										style="bottom: 20px; left: 10px"
									>
										<h4 x-text="item.name" class="text-light font-weight-bold"></h4>
										{{-- <div class="price">
											<h6>$150.00</h6>
											<h6 class="l-through">$210.00</h6>
										</div> --}}
										{{-- <div class="prd-bottom">

											<a href="" class="social-info">
												<span class="ti-bag"></span>
												<p class="hover-text">add to bag</p>
											</a>
											<a href="" class="social-info">
												<span class="lnr lnr-heart"></span>
												<p class="hover-text">Wishlist</p>
											</a>
											<a href="" class="social-info">
												<span class="lnr lnr-sync"></span>
												<p class="hover-text">compare</p>
											</a>
											<a href="" class="social-info">
												<span class="lnr lnr-move"></span>
												<p class="hover-text">view more</p>
											</a>
										</div> --}}
									</div>
									<div class="addtocart">
										<a :href="'/show/'+item.id" class="d-inline-block py-2 px-3 bg-light font-weight-bold text-lg"
										style="border-radius: 100px"
										>Show Item</a>
									</div>
								</div>
							</div>
							<!-- single product -->
						</template>
					</div>
				</section>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				{{-- <div class="filter-bar d-flex flex-wrap align-items-center">
					<div class="sorting mr-auto">
						<select>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
							<option value="1">Show 12</option>
						</select>
					</div>
					<div class="pagination">
						<a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
						<a href="#" class="active">1</a>
						<a href="#">2</a>
						<a href="#">3</a>
						<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
						<a href="#">6</a>
						<a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
				</div> --}}
				<!-- End Filter Bar -->
			</div>
					<div class="sticky-cart text-light">
						<div class="count-line">
							<div class="count-cart">
								<p>{{ Cart::count() }}</p>
							</div>
							<a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i></a>
						</div>
					</div>
		</div>
	</div>



	<script src="{{asset('karma/js/vendor/jquery-2.2.4.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="{{asset('karma/js/vendor/bootstrap.min.js')}}"></script>
	<script src="{{asset('karma/js/jquery.ajaxchimp.min.js')}}"></script>
	<script src="{{asset('karma/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{asset('karma/js/jquery.sticky.js')}}"></script>
	<script src="{{asset('karma/js/nouislider.min.js')}}"></script>
	<script src="{{asset('karma/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('karma/js/owl.carousel.min.js')}}"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="{{asset('karma/js/gmaps.min.js')}}"></script>
	<script src="{{asset('karma/js/main.js')}}"></script>

	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js" defer></script>

	<script type="text/javascript">
		function shoppine() {
			return {
				categories : @json($categories),
				items : @json($items),
				search : "",

				get filteredItems() {
	            if (this.search === "") {
	              return this.items;
	            }
	            return this.items.filter((item) => {
	              return item.name
	                .toLowerCase()
	                .includes(this.search.toLowerCase());
	            });
	          },
			}
		}

	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			const ordermes = @json(session('order'));
			if (ordermes) {
				$('.ordermes').show()
			};
			setTimeout(function(){
				$('.ordermes').hide()
			},3000)
		})

	</script>
</body>

</html>
