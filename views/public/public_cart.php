<?php
ob_start();
$page_title = "Cart";
include 'includes/header.php';
$empty_cart= "";

 if(!isset($_SESSION['id'])){
 	$user_id = $sid;
 	if($row = selectCart($conn, $user_id)){
 	extract($row);
 	
 	}
 }elseif(isset($_SESSION['id'])){
 	$user_id = $_SESSION['id'];
 	
 		if($row = selectCart($conn, $user_id)){
 		extract($row);
 		}
	}else{
 		$empty_cart = "<a href='product'>You Do not have any cart, click here to add to cart</a>";
 	}	
 

 ?>
 <!-- breadcrumbs -->
 	<div class="breadcrumbs">
 		<div class="container">
 			<ol class="breadcrumb breadcrumb1">
 				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
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
 					
 					<!-- <tr class="rem1">
 						<td class="invert">1</td>
 						<td class="invert-image"><a href="single.html"><img src="images/1.png" alt=" " class="img-responsive" /></a></td>
 						<td class="invert">
 							 <div class="quantity">
 								<div class="quantity-select">
 									<div class="entry value-minus">&nbsp;</div>
 									<div class="entry value"><span>1</span></div>
 									<div class="entry value-plus active">&nbsp;</div>
 								</div>
 							</div>
 						</td>
 						<td class="invert">Tata Salt</td>

 						<td class="invert">$290.00</td>
 						<td class="invert">
 							<div class="rem">
 								<div class="close1"> </div>
 							</div>
 							<script>$(document).ready(function(c) {
 								$('.close1').on('click', function(c){
 									$('.rem1').fadeOut('slow', function(c){
 										$('.rem1').remove();
 									});
 									});
 								});
 						   </script>
 						</td>
 					</tr> -->
 					<!-- <tr class="rem2">
 						<td class="invert">2</td>
 						<td class="invert-image"><a href="single.html"><img src="images/2.png" alt=" " class="img-responsive" /></a></td>
 						<td class="invert">
 							 <div class="quantity">
 								<div class="quantity-select">
 									<div class="entry value-minus">&nbsp;</div>
 									<div class="entry value"><span>1</span></div>
 									<div class="entry value-plus active">&nbsp;</div>
 								</div>
 							</div>
 						</td>
 						<td class="invert">Fortune oil</td>

 						<td class="invert">$250.00</td>
 						<td class="invert">
 							<div class="rem">
 								<div class="close2"> </div>
 							</div>
 							<script>$(document).ready(function(c) {
 								$('.close2').on('click', function(c){
 									$('.rem2').fadeOut('slow', function(c){
 										$('.rem2').remove();
 									});
 									});
 								});
 						   </script>
 						</td>
 					</tr>
 					<tr class="rem3">
 						<td class="invert">3</td>
 						<td class="invert-image"><a href="single.html"><img src="images/3.png" alt=" " class="img-responsive" /></a></td>
 						<td class="invert">
 							 <div class="quantity">
 								<div class="quantity-select">
 									<div class="entry value-minus">&nbsp;</div>
 									<div class="entry value"><span>1</span></div>
 									<div class="entry value-plus active">&nbsp;</div>
 								</div>
 							</div>
 						</td>
 						<td class="invert">Aashirvaad atta</td>

 						<td class="invert">$15.00</td>
 						<td class="invert">
 							<div class="rem">
 								<div class="close3"> </div>
 							</div>
 							<script>$(document).ready(function(c) {
 								$('.close3').on('click', function(c){
 									$('.rem3').fadeOut('slow', function(c){
 										$('.rem3').remove();
 									});
 									});
 								});
 						   </script>
 						</td>
 					</tr> -->
 							
 				</table>
 			</div>
 			<div class='checkout-left'>
 				<div class='checkout-left-basket'>
 					<div class='snipcart-details top_brand_home_details'>
 				<?php echo "<a href='checkout?cart_id=".$cart_id."'><input type='submit' class='button' value='Checkout' aria-hidden='true'></a>" ?>
 				</div>
 				</div>
 				<!-- <div class="checkout-left-basket">
 					<h4>Continue to basket</h4>
 					<ul>
 						<li>Product1 <i>-</i> <span>$15.00 </span></li>
 						<li>Product2 <i>-</i> <span>$25.00 </span></li>
 						<li>Product3 <i>-</i> <span>$29.00 </span></li>
 						<li>Total Service Charges <i>-</i> <span>$15.00</span></li>
 						<li>Total <i>-</i> <span>$84.00</span></li>
 					</ul>
 				</div> -->
 				<div class="checkout-right-basket">
 					<a href="home"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>Continue Shopping</a>
 				</div>
 				<div class="clearfix"> </div>
 			</div>
 		</div>
 	</div>
 <!-- //checkout
 <?php
include 'includes/footer.php';
  ?>
