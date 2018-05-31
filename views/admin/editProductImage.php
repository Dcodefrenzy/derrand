<?php
ob_start();
session_start();
authenticate();
$_SESSION['active'] = true;
if(!isset($_GET['product_id'])){
  header("Location:products");
}
#Links to the header2.php
$page_title = "Edit Product Image";
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
  define("MAX_FILE_SIZE", "2097152");

  $ext = ["image/jpg", "image/JPG", "image/jpeg", "image/JPEG", "image/PNG", "image/png"];
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
    unlink($file_path);
  $ver = compressImage($_FILES, 'pic' ,80, 'uploads/');
  replaceImagePath($conn, $ver,$_GET);
  }else{
  foreach ($error as $err){
    echo $err;
  }
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
  <div style="background:url('<?php echo $file_path?>'); height
  :200px; width: 200px; background-size: cover; background-position: center; background-repeat: no-repeat;" class="">

  </div>
  <div class="">
  <label id="lab" >Replace Image</label>
  <input type="file" name="pic">
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
