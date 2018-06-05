<?php
ob_start();
$page_title = "Register";
include 'includes/header.php';

$hash_id = $sid;

$error= [];

if(array_key_exists('register', $_POST)){

  if(empty($_POST['fname'])){
    $error['fname']="Enter a firstname";
  }

  if(empty($_POST['lname'])){
    $error['lname']="Enter a lastname";
  }

  if(empty($_POST['uname'])){
  	$error['uname'] = "Enter a username";
  }

  if(empty($_POST['email'])){
    $error['email']="Enter a email";
  }

  if(doesEmailExist($conn,$_POST['email'])){
    $error['email'] = "email already exists";
  }

  if(empty($_POST['password'])){
    $error['password']="Enter a password";
  }
  if(empty($_POST['pword'])){
    $error['pword']="enter confirm password";
  }

  if($_POST['pword']!=$_POST['password']){
    $error['pword']="Password mismatch";
  }
  

  if(empty($error)){
    $clean = array_map('trim', $_POST);
    doUserRegister($conn, $clean, $hash_id);

  }
  userLogin($conn, $clean);
}

?>
 

 <!-- breadcrumbs -->
 	<div class="breadcrumbs">
 		<div class="container">
 			<ol class="breadcrumb breadcrumb1 animated wow slideInLeft" data-wow-delay=".5s">
 				<?php echo "<li><a href=login?user_id=".$user_id."><span class='glyphicon glyphicon-home' aria-hidden='true'></span>Have an Account? <b>Login Here</b></a></li>"; ?>
 				<li class="active">Register Page</li>
 			</ol>
 		</div>
 	</div>
 <!-- //breadcrumbs -->
 <!-- register -->
 	<div class="register">
 		<div class="container">
 			<h2>Register Here</h2>
 			<div class="login-form-grids">
 				<h5>profile information</h5>
 				
 				<form action="" method="POST">
 					<?php $display = displayErrors($error, 'fname'); echo $display; ?>
 					<input type="text" placeholder="First Name..." required=" " name="fname" >
 					<?php $display = displayErrors($error, 'lname'); echo $display; ?>
 					<input type="text" placeholder="Last Name..." required=" " name="lname">
 					<?php $display = displayErrors($error, 'uname'); echo $display; ?>
 					<input type="text" placeholder="User Name" required=" " name="uname">
 				
 				<div class="register-check-box">
 					<div class="check">
 						<label class="checkbox"><input type="checkbox" name="checkbox"><i> </i>Subscribe to Newsletter</label>
 					</div>
 				</div>
 				<h6>Login information</h6>
 					
 					<?php $display = displayErrors($error, 'email'); echo $display; ?>
 					<input type="email" placeholder="Email Address" required=" " name="email" >
 					<?php $display = displayErrors($error, 'password'); echo $display; ?>
 					<input type="password" placeholder="Password" required=" " name="password">
 					<?php $display = displayErrors($error, 'pword'); echo $display; ?>
 					<input type="password" placeholder="Password Confirmation" required=" " name="pword" >
 					<div class="register-check-box">
 						<div class="check">
 							<label class="checkbox"><input type="checkbox" name="checkbox"><i> </i>I accept the terms and conditions</label>
 						</div>
 					</div>
 					<input type="submit" value="Register" name="register">
 				</form>
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
