<?php
ob_start();
$page_title = "Preview";
include 'includes/header.php';

if(!isset($_SESSION['id'])){
	$user_id = $sid;

}else{
	$user_id = $_SESSION['id'];

}


if(isset($_GET['hid'])){
	$hash_id = $_GET['hid'];

	 $result = viewpreviewProduct($conn, $hash_id);
	 extract($result);

	$error = [];

	if(array_key_exists("submit", $_POST)){
		if(empty($_POST['quantity'])){
			$error['quantity'] = "Please add quantity";
		}
		if(!is_numeric($_POST['quantity'])){
			$error['quantity'] = "Please add numeric value";
		}
		if(empty($error)){
			$clean = array_map('trim', $_POST);
			$total_price = $clean['quantity'] * $price;

			addToCart($conn, $user_id, $hash_id, $product_name, $total_price,$price, $clean);
		}
	}
}
 ?>
 <!-- breadcrumbs -->
 	<div class="breadcrumbs">
 		<div class="container">
 			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
 				<li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
 				<li class="active">Singlepage</li>
 			</ol>
 		</div>
 	</div>
 	<?php fetchPreviewProductroducts($conn, $hash_id) ?>
       				<form  method="post">
						<input type="number" name="quantity" placeholder="Quantity" required="" size="5"><br/><br/>
						<input type="submit" name="submit" value="Add to cart" class="button">
					</form>
      					</div>
    				</div>
  				</div>
  			<div class='clearfix'> </div>
		</div>
	</div>
</div>
 <!-- //breadcrumbs -->
 <!-- 	<div class="products">
 		<div class="container">
 			<div class="agileinfo_single">

 				<div class="col-md-4 agileinfo_single_left">
 					<img id="example" src="images/si1.jpg" alt=" " class="img-responsive">
 				</div>
 				<div class="col-md-8 agileinfo_single_right">
 				<h2>KHARAMORRA Khakra - Hariyali</h2>
 					<div class="rating1">
 						<span class="starRating">
 							<input id="rating5" type="radio" name="rating" value="5">
 							<label for="rating5">5</label>
 							<input id="rating4" type="radio" name="rating" value="4">
 							<label for="rating4">4</label>
 							<input id="rating3" type="radio" name="rating" value="3" checked="">
 							<label for="rating3">3</label>
 							<input id="rating2" type="radio" name="rating" value="2">
 							<label for="rating2">2</label>
 							<input id="rating1" type="radio" name="rating" value="1">
 							<label for="rating1">1</label>
 						</span>
 					</div>
 					<div class="w3agile_description">
 						<h4>Description :</h4>
 						<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
 							officia deserunt mollit anim id est laborum.Duis aute irure dolor in
 							reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
 							pariatur.</p>
 					</div>
 					<div class="snipcart-item block">
 						<div class="snipcart-thumb agileinfo_single_right_snipcart">
 							<h4 class="m-sing">$21.00 <span>$25.00</span></h4>
 						</div>
 						<div class="snipcart-details agileinfo_single_right_details">
 							<form action="#" method="post">
 								<fieldset>
 									<input type="hidden" name="cmd" value="_cart">
 									<input type="hidden" name="add" value="1">
 									<input type="hidden" name="business" value=" ">
 									<input type="hidden" name="item_name" value="pulao basmati rice">
 									<input type="hidden" name="amount" value="21.00">
 									<input type="hidden" name="discount_amount" value="1.00">
 									<input type="hidden" name="currency_code" value="USD">
 									<input type="hidden" name="return" value=" ">
 									<input type="hidden" name="cancel_return" value=" ">
 									<input type="submit" name="submit" value="Add to cart" class="button">
 								</fieldset>
 							</form>
 						</div>
 					</div>
 				</div>
 				<div class="clearfix"> </div>
 			</div>
 		</div>
 	</div> -->
 <!-- new -->
 	<div class="newproducts-w3agile">
 		<div class="container">
 			<h3>New offers</h3>
 				<div class="agile_top_brands_grids">
	<?php  userDisplayNewOffers($conn); ?>
 						<div class="clearfix"> </div>
 				</div>
 		</div>
 	</div>
 <!-- //new -->
 <?php
include 'includes/footer.php';
  ?>
