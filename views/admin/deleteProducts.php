<?php
ob_start();
session_start();
authenticate();
$page_title = "Delete Product";
$link= "#";


include 'include/header2.php';

if(!isset($_GET['product_id'])){
  header("Location:products");
}

$nm = getProductNameById($conn,$_GET);

if($nm == false){
  header("Location:/products");
}

if(isset($_POST['no'])){
  header("Location:/products");

}

if(isset($_POST['yes'])){
  $id= $_GET['id'];
  deleteProduct($conn, $_GET);
}

?>
<h1 id= \"register_label\"> Are You Sure You want to delete <?php echo $nm ?>?</h1>

<form id="register"  action="" method="post">
  <input type="submit" name="yes" value="Yes">
  <input type="submit" name="no" value="No">
</form>
<?php include 'include/footer.php'; ?>
