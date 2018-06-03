<?php
session_start();
ob_start();
$page_title = "Register";
include 'includes/header.php';
if(isset($_SESSION)){
  $fullname = $_SESSION['fullname'];
}
if(isset($_GET['user_id'])){
  $user_id = $_GET['user_id'];
}
delCart($conn, $user_id);

?>
 
 <!-- breadcrumbs -->
 	<div class="breadcrumbs">
 		<div class="container">
 			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
 				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
 				<li class="active">Comfirmation</li>

 			</ol>
 		</div>
 	</div>
 <!-- //breadcrumbs -->
 <!-- register -->
 	<div class="register">
 		<div class="container">
 			<h2>Comfirmation</h2>
 			<div class="login-form-grids">
 			<p>Dear, <?php echo "<b>".$fullname."</b>" ?> We are please to inform you that your purchase is successful, please check your email for more infomations</p>
 				
 					
 			</div>
 			<div class="register-home">
 				<a href="home">Home</a>
 			</div>
 		</div>
 	</div>
 <!-- //register -->
 <?php
include 'includes/footer.php';
  ?>
