<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
$welcome = "";
session_start();
$sid = md5(session_id());
$cart_numb = 0;
if(isset($_SESSION['username']) && ($_SESSION['id'])){
 	$fullname = $_SESSION['username'];
 	$user_id = $_SESSION['id'];
 	$welcome ="<li><a href=''>welcome ".$fullname."</a></li>";

 	$cart_numb = getCart($conn, $user_id);

}else{
  $cart_numb = getCart($conn, $sid);
}

 ?>


<!DOCTYPE html>
<html>
<head>
<title>Derrands|<?php echo $page_title ?></title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet">
<!-- //font-awesome icons -->
<!-- js -->
<script src="js/jquery-1.11.1.min.js"></script>
<!-- //js -->
<link href='//fonts.googleapis.com/css?family=Raleway:400,100,100italic,200,200italic,300,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->
</head>

<body>
<!-- header -->
	<div class="agileits_header">
		<div class="container">
			<div class="w3l_offers">
				<p>SALE UP TO 70% OFF. USE CODE "SALE70%" . <a href="product">SHOP NOW</a></p>
			</div>
			<div class="agile-login">
				<ul>
					<?php
if(isset($_SESSION['id']) && isset($_SESSION['username'])){

          echo $welcome; ?>



        <?php }else{ ?>
          <li><a href="register"> Create Account </a></li>
          <li><a href='login'>Login</a></li>

        <?php } ?>
<li><a href="contact">Help</a></li>

				</ul>
			</div>
			<div class="product_list_header">
		<?php echo "<li ><a class=\"badge-danger\" href='cart'>".$cart_numb."</a><a href='cart'><button class='w3view-cart' type='submit' name='submit' value=''><i class='fa fa-cart-arrow-down' aria-hidden='true'></i></button></a></li>" ?>
			</div>
			<div class="clearfix"> </div>
		</div>
	</div>

	<div class="logo_products">
		<div class="container">
		<div class="w3ls_logo_products_left1">
				<ul class="phone_email">
					<li><i class="fa fa-phone" aria-hidden="true"></i>Order online or call us : (+0123) 234 567</li>

				</ul>
			</div>
			<div class="w3ls_logo_products_left">
				<h1><a href="home">super Market</a></h1>
			</div>
		<!-- <div class="w3l_search">
			<form action="#" method="post">
				<input type="search" name="Search" placeholder="Search for a Product..." required="">
				<button type="submit" class="btn btn-default search" aria-label="Left Align">
					<i class="fa fa-search" aria-hidden="true"> </i>
				</button>
				<div class="clearfix"></div>
			</form>
		</div> -->

			<div class="clearfix"> </div>
		</div>
	</div>
<!-- //header -->
<!-- navigation -->
	<div class="navigation-agileits">
		<div class="container">
			<nav class="navbar navbar-default">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header nav_2">
								<button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
							</div>
							<div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
								<ul class="nav navbar-nav">
									<li class="active"><a href="home" class="act">Home</a></li>
									<!-- Mega Menu -->
									<?php  fetchMainCategory($conn); ?>
								<!-- 	<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Groceries<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>All Groceries</h6>
														<li><a href="groceries.html">Dals & Pulses</a></li>
														<li><a href="groceries.html">Almonds</a></li>
														<li><a href="groceries.html">Cashews</a></li>
														<li><a href="groceries.html">Dry Fruit</a></li>
														<li><a href="groceries.html"> Mukhwas </a></li>
														<li><a href="groceries.html">Rice & Rice Products</a></li>
													</ul>
												</div>

											</div>
										</ul>
									</li> -->
									<!-- <li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Household<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>All Household</h6>
														<li><a href="household.html">Cookware</a></li>
														<li><a href="household.html">Dust Pans</a></li>
														<li><a href="household.html">Scrubbers</a></li>
														<li><a href="household.html">Dust Cloth</a></li>
														<li><a href="household.html"> Mops </a></li>
														<li><a href="household.html">Kitchenware</a></li>
													</ul>
												</div>


											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Personal Care<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>Baby Care</h6>
														<li><a href="personalcare.html">Baby Soap</a></li>
														<li><a href="personalcare.html">Baby Care Accessories</a></li>
														<li><a href="personalcare.html">Baby Oil & Shampoos</a></li>
														<li><a href="personalcare.html">Baby Creams & Lotion</a></li>
														<li><a href="personalcare.html"> Baby Powder</a></li>
														<li><a href="personalcare.html">Diapers & Wipes</a></li>
													</ul>
												</div>

											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Packaged Foods<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>All Accessories</h6>
														<li><a href="packagedfoods.html">Baby Food</a></li>
														<li><a href="packagedfoods.html">Dessert Items</a></li>
														<li><a href="packagedfoods.html">Biscuits</a></li>
														<li><a href="packagedfoods.html">Breakfast Cereals</a></li>
														<li><a href="packagedfoods.html"> Canned Food </a></li>
														<li><a href="packagedfoods.html">Chocolates & Sweets</a></li>
													</ul>
												</div>


											</div>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">Beverages<b class="caret"></b></a>
										<ul class="dropdown-menu multi-column columns-3">
											<div class="row">
												<div class="multi-gd-img">
													<ul class="multi-column-dropdown">
														<h6>Tea & Coeffe</h6>
														<li><a href="beverages.html">Green Tea</a></li>
														<li><a href="beverages.html">Ground Coffee</a></li>
														<li><a href="beverages.html">Herbal Tea</a></li>
														<li><a href="beverages.html">Instant Coffee</a></li>
														<li><a href="beverages.html"> Tea </a></li>
														<li><a href="beverages.html">Tea Bags</a></li>
													</ul>
												</div>

											</div>
										</ul> -->
									<!-- </li> -->
									<li><a href="gourmet.html">Gourmet</a></li>
									<li><a href="offers.html">Offers</a></li>
									<li><a href="contact">Contact</a></li>
								</ul>
							</div>
							</nav>
			</div>
		</div>

<!-- //navigation -->
