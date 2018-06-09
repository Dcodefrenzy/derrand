<?php
ob_start();
$page_title = "Cart";
include 'includes/header.php';
$empty_cart= "";

 if(!isset($_SESSION['id'])){
 	$user_id = $sid;
 $row = selectCart($conn, $user_id);
 	extract($row);


}else{
 	$user_id = $_SESSION['id'];

 		$row = selectCart($conn, $user_id);
 		extract($row);
}

 ?>
 <!-- breadcrumbs -->
 	<div class="breadcrumbs">
 		<div class="container">
 			<ol class="breadcrumb breadcrumb1">
 				<li><a href="home"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
 				<li class="active">Checkout Page</li>
 			</ol>
 		</div>
 	</div>
 <!-- //breadcrumbs -->
 <!-- checkout -->
 	<div class="checkout">
 		<div class="container">
 			<h2>Your shopping cart contains: <span>3 Products</span></h2>
 			<?php echo '<p>'.$empty_cart.'</p>'; ?>
 			<div class="checkout-right">
 				<table class="timetable_sub">
 					<thead>
 						<tr>
 							<th>SL No.</th>
 							<th>Product</th>
 							<th>Quality</th>
 							<th>Product Name</th>

 							<th>Price</th>
 							<th>Remove</th>
 						</tr>
 					</thead>
 					<?php selectFromCart($conn, $user_id); ?>


 				</table>
 			</div>
 			<div class='checkout-left'>
 				<div class='checkout-left-basket'>
 					<div class='snipcart-details top_brand_home_details'>
 				<?php echo "<a href='checkout'><input type='submit' class='button' value='Checkout' aria-hidden='true'></a>" ?>
 				</div>
 				</div>

 				<div class="checkout-right-basket">
 					<a href="product"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
 				</div>
 				<div class="clearfix"> </div>
 			</div>
 		</div>
 	</div>

 <?php
include 'includes/footer.php';
  ?>
