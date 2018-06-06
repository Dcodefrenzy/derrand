<?php 

ob_start();
$page_title = "Preview";
include 'includes/header.php';
	
if(!isset($_SESSION['id'])){
	$user_id = $sid;
	
}else{
	$user_id = $_SESSION['id'];
	 
}

		if(array_key_exists("update", $_POST)){
			if(empty($_POST['update'])){
				$error['update'] = "Please input a value";
			}else{
				updateCart($conn, $_POST['quantity'], $user_id);
			}
		}

?>
						<?php while ($row = selectCart($conn, $user_id)) {
							extract($row)
						?>
					
					<form method="POST">
	             <input type='number' placeholder=<?php echo $quantity ?> name='quantity' size='3'>
                <input type='submit' value='Update' name='update' class='button' size='3'>
            		</form>


            		<?php }  ?>