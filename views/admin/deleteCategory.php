<?php
ob_start();
session_start();
authenticate();
$_SESSION['active'] = true;
$page_title = "Delete Category";
$link= "#";

if(!isset($_GET['id'])){
  header("Location:product_category");
}

include 'include/header2.php';
$view = getCategoryByID($conn, $_GET);
if($view == false){
  header("Location:product_category");
}

$error = [];

if(isset($_POST['no'])){

  if(empty($error)){
    header("Location:product_category");
  }
}

if(isset($_POST['yes'])){
  if(empty($error)){
    $id= $_GET['id'];
    deleteCategory($conn, $_GET);
  }
}
?>
<h1 id= \"register_label\"> Are You Sure You want to delete <?php echo $view ?>?</h1>

<form id="register"  action="" method="post">
  <input type="submit" name="yes" value="Yes">
  <input type="submit" name="no" value="No">
</form>

<?php include 'include/footer.php'; ?>
