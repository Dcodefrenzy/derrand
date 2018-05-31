<?php
ob_start();
session_start();
authenticate();
$_SESSION['active'] = true;
if(!isset($_GET['product_id'])){
  header("Location:products");
}
#Links to the header2.php
$page_title = "Edit Product";
$link= "#";



include 'include/header2.php';
$getp = getProductById($conn,$_GET);

  extract($getp);
if($getp == false){
  header("Location:products");
}
$flag = array("none", "top-selling", "popular-demand");
$availability = array("1" =>"Available", "2" =>"Not Available");
$promo = array("1" =>"On Promo", "2" =>"No Promo");


$error = [];

if(array_key_exists('add', $_POST)){
  // die(var_dump($_POST));

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

  if(empty($_POST['flag'])){
    $error['flag'] = "please enter flag";
  }

  if(empty($error)){
    $clean = array_map('trim', $_POST);
  editProducts($conn,$clean,$_GET);

  }

}





 ?>

 <?php if(isset($_GET['success'])){
   $msg = str_replace('_', ' ', $_GET['success']);
   echo $msg;
 } ?>

<div class="wrapper">

<form id="register" action="" method="POST" enctype="multipart/form-data">
 <div class="">
   <?php  $display = displayErrors($error, 'product_name');
    echo $display; ?>
<label for="">PRODUCT NAME</label>
<input type="text" name="product_name" value="<?php echo $product_name ?>
" placeholder="Product Name">
</div>
 <div class="">
   <?php  $display = displayErrors($error, 'description');
    echo $display; ?>
<label for="">description</label>
<textarea placeholder="Desription" name="description" rows="5" cols="10" style="margin: 0px; width: 298px; height: 139px;"><?php echo $description ?></textarea>
</div>

<div class="">
  <?php  $display = displayErrors($error, 'maker');
   echo $display; ?>
<label for="">PRODUCER </label>
 <input type="text" name="maker" value="<?php echo $maker ?>" placeholder="Producer">
</div>




<div class="">
  <?php  $display = displayErrors($error, 'category');
   echo $display; ?>
  <label for="">CATEGORY</label>
  <select value="<?php echo $category ?>" onchange="getSub(this.value)" class="" name="category">
  <option value="">-Select Category-</option>
  <?php viewCategory($conn) ?>
  </select>
</div>

<div class="">
  <?php  $display = displayErrors($error, 'sub_category');
   echo $display; ?>
  <label for="">SUB CATEGORY</label>
  <select id ="sub" class="" value="<?php echo $sub_category ?>" name="sub_category">
  <option value="">-Select Sub Category-</option>
  </select>
</div>

<div class="">
  <?php  $display = displayErrors($error, 'availability');
   echo $display; ?>
  <label for="">AVAILABILTY</label>
  <select value="<?php echo $availability ?>" class="" name="availability">
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
  <select value="<?php echo $promo_status ?>" class="" name="promo_status">
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
<input type="number" name="price" value="<?php echo $price ?>" placeholder="Price of Product">
</div>

<div class="">
  <?php  $display = displayErrors($error, 'old_price');
   echo $display; ?>
<label for="">OLD PRICE</label>
<input type="number" name="old_price" value="<?php echo $old_price ?>" placeholder="Old Price">
</div>

<div class="">
  <?php  $display = displayErrors($error, 'flag');
   echo $display; ?>
  <label for="">FLAG</label>
  <select value="<?php echo $flag ?>" class="" name="flag">
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
