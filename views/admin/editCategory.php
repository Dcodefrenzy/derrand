<?php
ob_start();
session_start();
authenticate();
$_SESSION['active'] = true;
if(!isset($_GET['id'])){
  header("Location:product_category");
}
$page_title = "Edit Category ";
$link= "#";
include 'include/header2.php';
$view = getCategoryByID($conn, $_GET);
if($view == false){
  header("Location:product_category");
}
$error = [];

if(array_key_exists('category', $_POST)){

  if(empty($_POST['category'])){
    $error['category'] = "Please enter category";
  }
  if(empty($error)){
    editCategory($conn, $_POST, $_GET);
  }
}
?>
<div class="wrapper">
  <div id="stream">





    <form id ="register" method="POST">
      <p>Edit Category</p>
      <?php  $display = displayErrors($error, 'category');
       echo $display; ?>
      <input type="text" name="category" placeholder ="enter category name"
      value="<?php echo $view;?>"
      >


      <input type="submit" name="edit" value="edit">


    </form>
    <table id= "tab">
      <td><a href="product_category" id="register ">Back</a></td>
    </table>



  </div>

  <?php include 'include/footer.php'; ?>
