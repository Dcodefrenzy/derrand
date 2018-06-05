<?php
$uri = explode("/", $_SERVER['REQUEST_URI']);
//var_dump($uri);

if(count($uri)> 2){
  header("Location:/admin_home");
}

//Creating A Null variable to be populated for the query String Route;
$category_id = NULL;
$category_name= NULL;

//Creating a $_GET condition to populate the Null Variables;
if(isset($_GET['id'])){
  $category_id = $_GET['id'];
}

$msg = NULL;
if(isset($_GET['msg'])){
  $msg = $_GET['msg'];
}
if(isset($_GET['name'])){
  $category_name = $_GET['name'];
}
$success = NULL;
if(isset($_GET['success'])){
  $success = $_GET['success'];
}

$product_id = NULL;
if(isset($_GET['product_id'])){
  $product_id = $_GET['product_id'];
}

$cart_id = NULL;
if(isset($_GET['cart_id'])){
  $cart_id = $_GET['cart_id'];
}
  $hid = NULL;
  if(isset($_GET['hid'])){
    $hid = $_GET['hid'];
  }
  $user_id = NULL;
  if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
  }
   $cart_id = NULL;
  if(isset($_GET['cart_id'])){
    $cart_id = $_GET['cart_id'];
  }


switch ($uri[1]) {
  case "admin":
  include APP_PATH."/views/admin/adminlogin.php";
  break;

  case "":
  include APP_PATH."/views/public/public_home.php";
  break;

  case "/":
  include APP_PATH."/views/public/public_home.php";
  break;

  case "admin?msg=$msg":
  include APP_PATH."/views/admin/adminlogin.php";
  break;

  case "admin_register":
  include APP_PATH."/views/admin/register.php";
  break;

  case "admin_home":
  include APP_PATH."/views/admin/adminhome.php";
  break;

  case "add_products":
  include APP_PATH."/views/admin/addProducts.php";
  break;

  case "del":
  include APP_PATH."/views/admin/deleteCategory.php";
  break;

  case "product_category":
  include APP_PATH."/views/admin/category.php";
  break;

  case "product_sub_category":
  include APP_PATH."/views/admin/subcategory.php";
  break;

  case "getSubCategory":
  include APP_PATH."/views/admin/ajax/subcategory.php";
  break;

  case "edit_products":
  include APP_PATH."/views/admin/editProducts.php";
  break;

  case "delete_products":
  include APP_PATH."/views/admin/deleteProducts.php";
  break;

  case "edit_sub_category":
  include APP_PATH."/views/admin/editSubCategory.php";
  break;

  case "edit_category":
  include APP_PATH."/views/admin/editCategory.php";
  break;

  case "products":
  include APP_PATH."/views/admin/products.php";
  break;

  #Routes With Query Strings are Below;
  case "editCategory?id=$category_id":
  include APP_PATH."/views/admin/editCategory.php";
  break;

  case "editSubCategory?id=$category_id":
  include APP_PATH."/views/admin/editSubCategory.php";
  break;

  case "edit_products?product_id=$product_id":
  include APP_PATH."/views/admin/editProducts.php";
  break;

  case "editProductImage?product_id=$product_id":
  include APP_PATH."/views/admin/editProductImage.php";
  break;

  case "deleteProducts?product_id=$product_id": //$product_id has been created
  include APP_PATH."/views/admin/deleteProducts.php";
  break;

  case "product_category?success=$success":
  include APP_PATH."/views/admin/category.php";
  break;

  case "logout":
  include APP_PATH."/views/admin/logout.php";
  break;

  case "product_sub_category?success=$success":
  include APP_PATH."/views/admin/subcategory.php";
  break;

  case "deleteCategory?id=$category_id":
  include APP_PATH."/views/admin/deleteCategory.php";
  break;

  case "deleteSubCategory?id=$category_id":
  include APP_PATH."/views/admin/deleteSubCategory.php";
  break;

  case "add_products?success=$success":
  include APP_PATH."/views/admin/addProducts.php";
  break;

  case "products?success=$success":
  include APP_PATH."/views/admin/products.php";
  break;











  ///////Public Routes//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  case "home":
  include APP_PATH."/views/public/public_home.php";
  break;

  case "product":
  include APP_PATH."/views/public/public_products.php";
  break;

  case "product?hid=$hid":
  include APP_PATH."/views/public/public_products.php";
  break;

  case "contact":
  include APP_PATH."/views/public/public_contact.php";
  break;

  case "login":
  include APP_PATH."/views/public/public_login.php";
  break;

  

   case "login?user_id=$user_id":
  include APP_PATH."/views/public/public_login.php";
  break;


  case "user_login?msg=$msg":
  include APP_PATH."/views/public/public_login.php";
  break;      

  case "register":
  include APP_PATH."/views/public/public_register.php";
  break;

  
   case "register?user_id=$user_id":
  include APP_PATH."/views/public/public_register.php";
  break;

  case "users_registration?success=$success":
  include APP_PATH."/views/public/public_register.php";
  break;

  case "cart":
  include APP_PATH."/views/public/public_cart.php";
  break;

  
  case "cart?user_id=$user_id":
  include APP_PATH."/views/public/public_cart.php";
  break;


  case "preview":
  include APP_PATH."/views/public/public_preview.php";
  break;

  case "preview?hid=$hid":
  include APP_PATH."/views/public/public_preview.php";
  break;

  case "getSub":
  include APP_PATH."/views/public/get_sub_category.php";
  break;

  
  case "checkout":
  include APP_PATH."/views/public/public_home.php";
  break;

  case "checkout?cart_id=$cart_id":
  include APP_PATH."/views/public/checkout.php";
  break;




  
  case "comfirmation?user_id=$user_id":
  include APP_PATH."/views/public/comfirmation.php";
  break;

  case "comfirmation":
  include APP_PATH."/views/public/public_home.php";
  break;



}





?>
