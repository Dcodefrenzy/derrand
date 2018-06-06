<?php 

ob_start();
$page_title = "Preview";
include 'includes/header.php';
	
if(!isset($_SESSION['id'])){
	$user_id = $sid;
	
}else{
	$user_id = $_SESSION['id'];
	 
}
?>



