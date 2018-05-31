<?php
ob_start();
session_start();
authenticate();
$_SESSION['active'] = true;

#Links to the header2.php
$page_title = "Add Products";
$link= "add_products";




include 'include/header2.php';



$flag = array("none", "top-selling", "popular-demand");
$availability = array("1" =>"Available", "2" =>"Not Available");
$promo = array("1" =>"On Promo", "2" =>"No Promo");


$error = [];

if(array_key_exists('add', $_POST)){
  //die(var_dump($_POST));
  define("MAX_FILE_SIZE", "2097152");

  $ext = ["image/jpg", "image/JPG", "image/jpeg", "image/JPEG", "image/PNG", "image/png"];

  if(empty($_POST['product_name'])){
    $error['product_name'] = "Please enter Product name";
  }

  if(empty($_POST['maker'])){
    $error['maker'] = "Please enter Producer";
  }

  if(empty($_POST['category'])){
    $error['category'] = "Please enter Category";
  }

  if(empty($_POST['sub_category'])){
    $error['sub_category'] = "Please enter Sub-Category";
  }

  if(empty($_POST['description'])){
    $error['description'] = "Please enter Description";
  }

  if(empty($_POST['price'])){
    $error['price'] = "Please enter Price";
  }

  if(empty($_POST['old_price'])){
    $error['old_price'] = "Please enter Previous Price";
  }

  if (empty($_POST['availability'])){
    $error['availability'] = "please enter Product Availability";
  }

  if(empty($_POST['promo_status'])){
    $error['promo_status'] = "Please enter Promo Status";
  }

  if(empty($_POST['old_price'])){
    $error['old_price'] = "please enter old_price";
  }

  if(empty($_POST['flag'])){
    $error['flag'] = "please enter flag";
  }

  if(empty($_FILES['pic']['name'])){
    $error['pic'] = "please choose a file";
  }

  if($_FILES['pic']['size'] > MAX_FILE_SIZE){
    $error['pic'] = "file size exceeds maximum. maximum:".MAX_FILE_SIZE;
  }





  if(!in_array($_FILES['pic']['type'], $ext)){
    $error['pic'] = "Invalid file type";


  }

  if(empty($error)){


    $ver = compressImage($_FILES, 'pic',80, 'uploads/');

      $destination = $ver;
  $clean = array_map('trim', $_POST);
// var_dump($clean);
  addProducts($conn,$clean,$destination);

}

}





 ?>

 <?php if(isset($_GET['success'])){
   $msg = str_replace('_', ' ', $_GET['success']);
   echo $msg;
 } ?>

<div class="wrapper">
 <h2>PLEASE SELECT FILE</h2>
<form id="register" action="" method="POST" enctype="multipart/form-data">
<div class="">
<label id="lab" >Upload file</label>
<input type="file" name="pic">
</div>

 <div class="">
  <?php  $display = displayErrors($error, 'product_name');
   echo $display; ?>
<label for="">PRODUCT NAME</label>
<input type="text" name="product_name" value="" placeholder="Product Name">
</div>
 <div class="">
   <?php  $display = displayErrors($error, 'description');
    echo $display; ?>
<label for="">description</label>
<textarea placeholder="Desription" name="description" rows="5" cols="10" style="margin: 0px; width: 298px; height: 139px;"></textarea>
</div>

<div class="">
  <?php  $display = displayErrors($error, 'maker');
   echo $display; ?>
<label for="">PRODUCER </label>
 <input type="text" name="maker" value="" placeholder="Producer">
</div>




<div class="">
  <?php  $display = displayErrors($error, 'category');
   echo $display; ?>
  <label for="">CATEGORY</label>
  <select onchange="getSub(this.value)" class="" name="category">
  <option value="">-Select Category-</option>
  <?php viewCategory($conn) ?>
  </select>
</div>

<div class="">
  <?php  $display = displayErrors($error, 'sub_category');
   echo $display; ?>
  <label for="">SUB CATEGORY</label>
  <select id ="sub" class="" name="sub_category">
  <option value="">-Select Sub Category-</option>
  </select>
</div>

<div class="">
  <?php  $display = displayErrors($error, 'availability');
   echo $display; ?>
  <label for="">AVAILABILTY</label>
  <select class="" name="availability">
    <option value="">-Select Availability-</option>
    <?php foreach($availability as $num => $status){?>
    <option value="<?php echo $num  ?>">
  <?php echo $status  ?>
  </option>
<?php  }?>
  </select>
</div>

<div class="">
  <?php  $display = displayErrors($error, 'promo_status');
   echo $display; ?>
  <label for="">PROMO STATUS</label>
  <select class="" name="promo_status">
    <option value="">-Select Promo Status-</option>
    <?php foreach($promo as $num => $status){?>
    <option value="<?php echo $num  ?>">
  <?php echo $status  ?>
  </option>
<?php  }?>
  </select>
</div>

<div class="">
  <?php  $display = displayErrors($error, 'price');
   echo $display; ?>
<label for="">PRICE</label>
<input type="number" name="price" value="" placeholder="Price of Product">
</div>

<div class="">
  <?php  $display = displayErrors($error, 'old_price');
   echo $display; ?>
<label for="">OLD PRICE</label>
<input type="number" name="old_price" value="" placeholder="Old Price">
</div>

<div class="">
  <?php  $display = displayErrors($error, 'flag');
   echo $display; ?>
  <label for="">FLAG</label>
  <select class="" name="flag">
    <option value="">-Select Flag-</option>
    <?php foreach($flag as $ff){?>
    <option value="<?php echo $ff  ?>">
  <?php echo $ff  ?>
  </option>
<?php  }?>
  </select>
</div>

<input type="submit" name="add" value="Add Product">
</form>


</div>
<script type="text/javascript">
function getSub(id){

  var url = 'getSubCategory';
  var method = 'POST';
  var params = 'cat_id='+ id;

  ////console.log(url);
  contactAjax(url, method, params);
}

function contactAjax(url, method, params){
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function(){
    if(xhr.readyState == 4){
      var res = xhr.responseText;
      document.getElementById('sub').innerHTML = res ;
    }
  }
  xhr.open(method, url, true);
  xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
  xhr.send(params);
}
</script>
<?php include 'include/footer.php'; ?>
