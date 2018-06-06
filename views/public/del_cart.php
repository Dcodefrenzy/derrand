<?php 
ob_start();
$page_title = "Preview";
include 'includes/header.php';
	
if(!isset($_SESSION['id'])){
	$user_id = $sid;
	
}else{
	$user_id = $_SESSION['id'];
	 
}

if (isset($_GET['cart_id'])) {
	$cart = $_GET['cart_id'];
	
}

delCart($conn, $user_id, $cart);
header("Location:cart");

 ?>