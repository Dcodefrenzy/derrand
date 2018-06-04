<?php
session_start();
ob_start();
$page_title = "Checkout";
include 'includes/header.php';

	if(!isset($_SESSION['id'])){
    header("Location:register?user_id=".$user_id."");
  }
 if(isset($_GET['user_id']) && ($_GET['cart_id'])){
 	$user_id = $_GET['user_id'];
 	$cart_id = $_GET['cart_id'];
  
 }else{
 	header("Location:home");
 }
 	 
 	

 	$error = [];
 if(array_key_exists("purchase", $_POST)){
 	 
 	 if(empty($_POST['fname'])){
    	$error['fname']="please inpute your full name";  		
     }

  	 if(empty($_POST['pnumber'])){
    	$error['pnumber']="please input your phone Number";
  	 }
  	  if(!is_numeric($_POST['pnumber'])){
    	$error['pnumber']="please input numeric value for this field";
  	 }
 	 if(empty($_POST['adress'])){
    	$error['adress']="please input your adress";
  	 }
  
  	 if(empty($error)){
    	$clean = array_map('trim', $_POST);
    		
    		addCheckout($conn, $user_id, $clean);	
  	 }
 	}

 ?>
 	


 	<div class="breadcrumbs">
 		<div class="container">
 			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
 				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
 				<li class="active">Register Page</li>
 			</ol>
 		</div>
 	</div>

 <!-- //breadcrumbs -->
 <!-- register -->
 	<div class="register">
 		<div class="container">
 			<h2>Register Here</h2>
 			<div class='checkout-left'>
 				<div class="checkout-left-basket">
 					<h4>Continue to basket</h4>
 					<ul>
 						<?php displayCheckout($conn, $user_id); ?>
 					</ul>
 				</div>
 			<div class="login-form-grids">
 				<h5>Buyer information</h5>
 				
 				<form  method="POST">
 					<?php $display = displayErrors($error, 'fname'); echo $display; ?>
 					<input type="text" placeholder="FullName" required=" " name="fname" >
 					<?php $display = displayErrors($error, 'pnumber'); echo $display; ?>
 					<input type="text" placeholder="PhoneNumber" required=" " name="pnumber">
 					<?php $display = displayErrors($error, 'adress'); echo $display; ?>
 					<input type="text" placeholder="Adress" required=" " name="adress">
 				
 				<div class="register-check-box">
 					<div class="check">
 						<label class="checkbox"><input type="checkbox" name="checkbox"><i> </i>Subscribe to Newsletter</label>
 					</div>
 				</div>	
 					<input type="submit" value="purchase" name="purchase">
 				</form>
 			</div>
 		</div>
 	</div>
 							

 					
										
<?php 
include 'includes/footer.php';
 ?>