<?php
ob_start();
session_start();
$page_title = "Login";
include 'includes/header.php';


$error =  []; 
if(array_key_exists('login', $_POST)){

  if(empty($_POST['email'])){
    $error['email'] = "Please enter email";
  }
  if(empty($_POST['hash'])){
    $error['hash'] = "please enter password";
  }

  if(empty($error)){
    $clean = array_map('trim', $_POST);

    userLogin($conn, $clean);
  }

}


 ?>
 <!-- breadcrumbs -->
 	<div class="breadcrumbs">
 		<div class="container">
 			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
 				<li><a href="index.html"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>Home</a></li>
 				<li class="active">Login Page</li>
 			</ol>
 		</div>
 	</div>
 <!-- //breadcrumbs -->
 <!-- login -->
 	<div class="login">
 		<div class="container">
 			<h2>Login Form</h2>

 			<div class="login-form-grids animated wow slideInUp" data-wow-delay=".5s">
 				<form method="POST">
 					<?php $display = displayErrors($error, 'fname'); echo $display; ?>
 					<input type="email" placeholder="Email Address" required=" " name="email" >
 					<?php $display = displayErrors($error, 'fname'); echo $display;  ?>
 					<input type="password" placeholder="Password" required=" " name="hash">
 					<div class="forgot">
 						<a href="#">Forgot Password?</a>
 					</div>
 					<input type="submit" value="Login" name="login">
 				</form>
 			</div>
 			<h4>For New People</h4>
 			<p><a href="register">Register Here</a> (Or) go back to <a href="home">Home<span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></p>
 		</div>
 	</div>
 <!-- //login -->
 <?php
include 'includes/footer.php';
  ?>
