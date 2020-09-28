@php
$v = new App\Model\Variant;
$s = new App\Model\Size;
@endphp
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
	<link rel="stylesheet" href="{{asset('karma/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('karma/css/themify-icons.css')}}">
	<link rel="stylesheet" href="{{asset('karma/css/bootstrap.css')}}">
	<link rel="stylesheet" href="{{asset('karma/css/owl.carousel.css')}}">
	<link rel="stylesheet" href="{{asset('karma/css/nice-select.css')}}">
	<link rel="stylesheet" href="{{asset('karma/css/nouislider.min.css')}}">
	<link rel="stylesheet" href="{{asset('karma/css/ion.rangeSlider.css')}}" />
	<link rel="stylesheet" href="{{asset('karma/css/ion.rangeSlider.skinFlat.css')}}" />
	<link rel="stylesheet" href="{{asset('karma/css/main.css')}}">
	<link rel="stylesheet" href="{{asset('css/itemshop.css')}}">
</head>

<body>

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
									<li class="nav-item"><a class="nav-link" href="category.html">Shop Category</a></li>
									<li class="nav-item active"><a class="nav-link" href="single-product.html">Product Details</a></li>
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
					<h1>Product Details Page</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
						<a href="single-product.html">product-details</a>
					</nav>
				</div>
			</div>
		</div>
	</section> --}}
	<!-- End Banner Area -->

	<!--================Single Product Area =================-->
	<div class="product_image_area m-4 p-0" x-data="detail({{ $item->id }})">
		<div class="container">
			<div class="row s_product_inner position-relative">
				<div class="col-lg-6">
					<div class="s_Product_carousel">
						<div class="single-prd-item">
							<img class="img-fluid" src="{{ asset('image/'.$item->image) }}" alt="">
						</div>
						<div class="single-prd-item">
							<img class="img-fluid" src="{{ asset('image/'.$item->image) }}" alt="">
						</div>
						<div class="single-prd-item">
							<img class="img-fluid" src="{{ asset('image/'.$item->image) }}" alt="">
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text m-0">
						<p class="m-0 p-0 border-0">{{ $item->category->name }}</p>
						<p class="text-light display-4 font-weight-bold m-0">{{ $item->name }}</p>
						{{-- <h2>$149.99</h2> --}}
						{{-- <ul class="list">
							<li><a class="active" href="#"><span>Category</span> : Household</a></li>
							<li><a href="#"><span>Availibility</span> : In Stock</a></li>
						</ul> --}}
						<p class="description mb-3">{{ $item->description }}</p>

						<form action="{{ route('addCart') }}" method="post">
							@csrf
							<input type="hidden" name="item" value="{{ $item->name }}">
							<input type="hidden" name="detailid" x-model="detailid">
							<div class="form-group">
							  <div class="custom-body">
							    <div class="custom-container">
							      <div>
							      	<p class="font-weight-bold mb-2 p-0">Variant :</p>
							      </div>
							      <div>
								      <ul class="">
								      	@php
								      	$detail = $item->detail->pluck('variant_id');
								      	$variants = $v->whereIn('id', $detail)->get();
								      	@endphp
								      	@foreach($variants as $key => $variant )
								      		<input class="checkbox-tools" type="radio" name="variant" id="variant-{{ $key }}" x-model="variant" x-on:change="setPrice()" value="{{ $variant->id }}">
		      								<label class="for-checkbox-tools m-0" for="variant-{{ $key }}">
		      									{{ $variant->name }}
		      								</label>
								      	@endforeach
								      		<input type="hidden" name="vname" x-model="variant">
								      </ul>
							      </div>

							    </div>

							  </div>
							</div>

							<div class="form-group">
							  <div class="custom-body">
							    <div class="custom-container">
							      <div>
							      	<p class="font-weight-bold mb-2 p-0">Size :</p>
							      </div>
							      <div>
								      <ul class="">
								      	@php
								      	$detail = $item->detail->pluck('size_id');
								      	$sizes = $s->whereIn('id', $detail)->get();
								      	@endphp
								      	@foreach($sizes as $key => $size )
								      		<input class="checkbox-tools" type="radio" name="size" id="size-{{ $key }}" x-model="size" x-on:change="setPrice()" value="{{ $size->id }}">
								      		{{-- <input type="hidden" name="sname" value="{{ $size->name }}"> --}}
		      								<label class="for-checkbox-tools m-0" for="size-{{ $key }}">
		      									{{ $size->name }}
		      								</label>
								      	@endforeach
								      	<input type="hidden" name="sname" x-model="size">
								      </ul>
							      </div>

							    </div>

							  </div>
							</div>


							<div class="mb-3">
								<p class="p-0 font-weight-bold">Price: </p>
								<p class="p-0 text-right font-weight-bold m-0 w-100">
									<span>Rp.</span><span x-text="itemprice"></span>
									<input type="hidden" name="price" x-model="itemprice">
								</p>
							</div>

							<div class="product_count">
							    <label for="qty" class="for-checkbox-tools font-weight-bold p-0 text-light text-lg">Quantity :</label>
								<input type="number" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty" x-model="qty" x-on:change="setPrice()">
								{{-- <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
								 class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button x-on:click="setPrice()">
								<button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
								 class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button x-on:click="setPrice()"> --}}
							</div>

							<div class="mb-3">
								<p class="p-0 font-weight-bold">Total : </p>
								<p class="p-0 text-right font-weight-bold m-0 w-100"><span>Rp.</span><span x-text="pricetotal"></span>
									<input type="hidden" name="total" x-model="pricetotal">
								</p>
							</div>

							<div class="card_area d-flex align-items-center">
								<button class="primary-btn" href="#">Add to Cart</button>
								<a class="icon_btn" href="#"><i class="lnr lnr lnr-diamond"></i></a>
								<a class="icon_btn" href="#"><i class="lnr lnr lnr-heart"></i></a>
							</div>
						</form>
					</div>
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
	</div>
	<!--================End Single Product Area =================-->

	<!-- start footer Area -->
	{{-- <footer class="footer-area section_gap">
		<div class="container">
			<div class="row">
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>About Us</h6>
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore
							magna aliqua.
						</p>
					</div>
				</div>
				<div class="col-lg-4  col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Newsletter</h6>
						<p>Stay update with our latest</p>
						<div class="" id="mc_embed_signup">

							<form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01"
							 method="get" class="form-inline">

								<div class="d-flex flex-row">

									<input class="form-control" name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '"
									 required="" type="email">


									<button class="click-btn btn btn-default"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>
									<div style="position: absolute; left: -5000px;">
										<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
									</div>

									<!-- <div class="col-lg-4 col-md-4">
												<button class="bb-btn btn"><span class="lnr lnr-arrow-right"></span></button>
											</div>  -->
								</div>
								<div class="info"></div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-lg-3  col-md-6 col-sm-6">
					<div class="single-footer-widget mail-chimp">
						<h6 class="mb-20">Instragram Feed</h6>
						<ul class="instafeed d-flex flex-wrap">
							<li><img src="img/i1.jpg" alt=""></li>
							<li><img src="img/i2.jpg" alt=""></li>
							<li><img src="img/i3.jpg" alt=""></li>
							<li><img src="img/i4.jpg" alt=""></li>
							<li><img src="img/i5.jpg" alt=""></li>
							<li><img src="img/i6.jpg" alt=""></li>
							<li><img src="img/i7.jpg" alt=""></li>
							<li><img src="img/i8.jpg" alt=""></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-2 col-md-6 col-sm-6">
					<div class="single-footer-widget">
						<h6>Follow Us</h6>
						<p>Let us be social</p>
						<div class="footer-social d-flex align-items-center">
							<a href="#"><i class="fa fa-facebook"></i></a>
							<a href="#"><i class="fa fa-twitter"></i></a>
							<a href="#"><i class="fa fa-dribbble"></i></a>
							<a href="#"><i class="fa fa-behance"></i></a>
						</div>
					</div>
				</div>
			</div>
			<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
				<p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</p>
			</div>
		</div>
	</footer> --}}
	<!-- End footer Area -->

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


	{{-- alpinejs --}}
	<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js" defer></script>
	<script type="text/javascript">
		function detail(item) {
			const details = @json($details);

			return {
				item: item,
				detailid: null,
				pricetotal : 0,
				variant: null,
				size: null,
				qty: 1,
				itemprice: 0,

				setPrice() {
					const price = details.find(detail => detail.item_id == this.item && detail.variant_id == this.variant && detail.size_id == this.size);
					this.detailid = price.id;
					this.itemprice = price.price;
					this.pricetotal = price.price * this.qty;
					console.log(this.qty);
				},
			}
		}
	</script>


</body>

</html>
