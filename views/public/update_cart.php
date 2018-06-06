<?php
ob_start();
$page_title = "Preview";
include 'includes/header.php';

		if(array_key_exists("update", $_POST)){
			if(empty($_POST['quantity'])){
				$error['quantity'] = "Please input a value";
			}else{
				$clean = array_map("trim",$_POST);




				editCart($conn,$clean,$_GET['cart_id']);
			}
		}
