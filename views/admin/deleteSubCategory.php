<?php
ob_start();
session_start();
authenticate();
$_SESSION['active'] = true;
if(!isset($_GET['id'])){
  header("Location:products_sub_category");
}
$page_title = "Delete Sub Category";
$link= "#";


include 'include/header2.php';
$view = getSubCategoryByID($conn, $_GET);
if($view == false){
  header("Location:product_sub_category");
}


$error = [];

if(isset($_POST['no'])){

  if(empty($error)){
    header("Location:product_sub_category");
  }
}

if(isset($_POST['yes'])){
  if(empty($error)){
    $id= $_GET['id'];
    deleteSubCategory($conn, $_GET);
  }
}
?>
<h1 id= \"register_label\"> Are You Sure You want to delete <?php echo $view ?>?</h1>

<form id="register"  action="" method="post">
  <input type="submit" name="yes" value="Yes">
  <input type="submit" name="no" value="No">
</form>

<?php include 'include/footer.php'; ?>
