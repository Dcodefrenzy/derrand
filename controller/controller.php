<?php
define("DB_PATH", dirname(dirname(__FILE__)));
include DB_PATH."/model/db.php";

function doesEmailExist($dbconn, $input){ #placeholders are just there
  $result = false;
  $stmt = $dbconn -> prepare("SELECT * FROM admin WHERE email = :em");
  $stmt->bindParam(":em",$input);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count>0){
    $result = true;
  }
  return $result;
}


function displaySubCategory($dbconn, $id){
$stmte->bindParam(":cid", $id);
$stmte->execute();
$result = "";
while($ret = $stmte->fetch(PDO::FETCH_BOTH)){
  extract($ret);

$result = $result .
"<ul>
    <li><a href=\"products.html\"><i class=\"fa fa-arrow-right\" aria-hidden=\"true\"></i></li>
  </ul>";
}

return $result;
}

function displayCategories($dbconn){
  $stmt =$dbconn->prepare("SELECT * FROM category");
  $stmt->execute();
  $result = "";
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
    $result = $result .
    "<li id=\"$category_id\" onclick=\"getSubCategory('$category_id');\"><a href=\"#\"><i class=\"fa fa-arrow-right\" aria-hidden=\"true\"></i>$category_name</a></li><ul>
        <li><a id=\"ba$category_id\"href=\"products.html\"><i class=\"fa fa-arrow-right\" aria-hidden=\"true\"></i></a></li>
      </ul>";
  }
  return $result;
}




function authenticate(){
  if(!isset($_SESSION['admin_id']) && !isset($_SESSION['admin_name'])){
    $mes = 'Please confirm your login to access that page';
    $message = preg_replace('/\s+/', '_', $mes);
    header("Location:admin?msg=$message");
  }
}

function doAdminRegister($dbconn, $input){
  $hash = password_hash($input['password'], PASSWORD_BCRYPT);
  #insert data
  $stmt = $dbconn->prepare("INSERT INTO admin(firstname,lastname,email,hash) VALUES(:fn, :ln, :e, :h)");

  #bind params...
  $data = [ ':fn' => $input['fname'],
  ':ln' => $input['lname'],
  ':e' => $input['email'],
  ':h' => $hash
];

$stmt->execute($data);
}

function getProductsByID($dbconn, $productID) {
  $stmt = $dbconn->prepare("SELECT * FROM product WHERE product_id=:id");
  $stmt->bindParam(':id', $productID);

  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_ASSOC);

  return $row;
}



function displayErrors($error, $field){
  $result= "";
  if (isset($error[$field])){
    $result = '<span class="err">'.$error[$field].'</span>';
  }
  return $result;
}


function adminLogin($dbconn, $input){
  $result = [];

  $stmt = $dbconn->prepare("SELECT * FROM admin WHERE email = :e ");

  $stmt ->bindParam(":e", $input['email']);
  $stmt->execute();

  $row = $stmt->fetch(PDO::FETCH_BOTH);

  if($stmt->rowCount() !=1 || !password_verify($input['password'], $row['hash'])){



    header('/admin');
  }else{
    $result[] = true;
    $result[] = $row;
    extract($row);
    $_SESSION['admin_id'] = $admin_id;
    $_SESSION['admin_name'] = $firstname;

    header("Location: /admin_home");
  }

  return $result;
  return $_SESSION['admin_id'];
  return $_SESSION['admin_name'];

}



function addCategory($dbconn, $post){
  $rnd = rand(0000000000,9999999999);
  $hash_id = 'cat'.$rnd;
  $stmt = $dbconn->prepare("INSERT INTO category(category_name,hash_id, date_created) VALUES(:cat,:hid,NOW())");
  $stmt->bindParam(":cat",$post['categ']);
  $stmt->bindParam(":hid",$hash_id);

  $stmt->execute();

  $success = "Category Succefully Added";
  $succ = preg_replace('/\s+/', '_', $success);

  header("Location: /product_category?success=$succ");
}

function addSubCategory($dbconn, $post){
  $rnd = rand(0000000000,9999999999);
  $hash_id = 'sub'.$rnd;


  $stmt = $dbconn->prepare("INSERT INTO sub_category(category_id, sub_category_name,hash_id, date_created) VALUES(:cat_id,:scat,:hid,NOW())");

  $stmt->bindParam(":cat_id",$post['category']);
  $stmt->bindParam(":scat",$post['categ']);
  $stmt->bindParam(":hid",$hash_id);
  $stmt->execute();

  $success = "Sub Category Succefully Added";
  $succ = preg_replace('/\s+/', '_', $success);
  header("Location: /product_sub_category?success=$succ");
}

function viewProducts($dbconn){
  $stmt = $dbconn->prepare("SELECT * FROM product");
  $stmt->execute();
  while($record = $stmt->fetch()){
    if($record['availability'] == 1){
    $record['availability'] = "Available";
    }
    if($record['availability'] == 2){
    $record['availability'] = "Not Available";
    }
    if($record['promo_status'] == 2){
    $record['promo_status'] = "No Promo";
    }
    if($record['promo_status'] == 1){
    $record['promo_status'] = "On Promo";
    }

    echo "<tr>";
    echo "<td>".$record['description']."</td>";
    echo "<td>".$record['product_id']."</td>";
    echo "<td>".$record['product_name']."</td>";
    echo "<td>".$record['maker']."</td>";
    echo "<td>".$record['category']."</td>";
    echo "<td>".$record['sub_category']."</td>";
    echo "<td>#".$record['price']."</td>";
    echo "<td>#".$record['old_price']."</td>";
    echo "<td>".$record['availability']."</td>";
    echo "<td>".$record['promo_status']."</td>";
    echo "<td><a href=\"editProductImage?product_id=".$record['hash_id']."\"><div style=\"background:url('".$record['file_path']."'); height
    :50px; width: 50px; background-size: cover; background-position: center; background-repeat: no-repeat;\"></div></a></td>";
    echo "<td>".$record['flag']."</td>";

    echo "<td><a href=\"edit_products?product_id=".$record['hash_id']."\">edit</a></td>";
    echo "<td><a href=\"deleteProducts?product_id=".$record['hash_id']."\">delete</a></td>";
    echo "</tr>";
  }
}


function viewSubCategories($dbconn){

  $stmt = $dbconn->prepare("SELECT * FROM sub_category");
  $stmt->execute();
  while($record = $stmt->fetch()){
    extract($record);
    echo "<tr>";
    echo "<td>".$sub_category_id."</td>";
    echo "<td>".$category_id."</td>";
    echo "<td>".$sub_category_name."</td>";
    echo "<td>".$date_created."</td>";
    $red = preg_replace('/\s+/', '_', $sub_category_name);
    echo "<td><a href=\"editSubCategory?id=".$hash_id."\">edit</a></td>";
    echo "<td><a href=\"deleteSubCategory?id=".$hash_id."\">delete</a></td>";
    echo "</tr>";
  }
}
function viewCategories($dbconn){



  $stmt = $dbconn->prepare("SELECT * FROM category");
  $stmt->execute();
  while($record = $stmt->fetch()){
    extract($record);
    echo "<tr>";
    echo "<td>".$category_id."</td>";
    echo "<td>".$category_name."</td>";
    echo "<td>".$date_created."</td>";
    $red = preg_replace('/\s+/', '_', $category_name);
    echo "<td><a href=\"editCategory?id=".$hash_id."\">edit</a></td>";
    echo "<td><a href=\"deleteCategory?id=".$hash_id."\">delete</a></td>";
    echo "</tr>";
  }
}


function viewCategory($dbconn){
  $stmt = $dbconn->prepare("SELECT * FROM category");
  $stmt->execute();
  while($record = $stmt->fetch()){
    extract($record);
    echo "<option value=\" $category_id\">$category_name</option>";
  }
}


function editCategory($dbconn, $post, $get){
$id = getIdByHashId($dbconn,'category_id','category_id','category',$get['id']);

  $stmt = $dbconn->prepare("UPDATE category SET category_name=:name WHERE category_id= :id");

  $stmt->bindParam(":name" , $post['category']);
  $stmt -> bindParam(":id", $id);
  $stmt->execute();

  header("Location: /product_category");
}

function editSubCategory($dbconn, $post, $get){

  $stmt = $dbconn->prepare("UPDATE sub_category SET sub_category_name=:name WHERE hash_id= :id");

  $stmt->bindParam(":name" , $post['category']);
  $stmt -> bindParam(":id", $get['id']);
  $stmt->execute();

  header("Location: /product_sub_category");
}
// function getIdByHashId($dbconn,$id_name,$id,$table,$hash_id){
//   $stmt = $dbconn->prepare("SELECT $id_name FROM $table WHERE hash_id = :hid ");
//   $stmt->bindParam(":hid", $hash_id);
//   $stmt->execute();
//   $row = $stmt->fetch(PDO::FETCH_BOTH);
//   return $row[$id_name];
// }


function getCategoryById($dbconn,$get){
$id =  getIdByHashId($dbconn,'category_id','category_id','category',$get['id']);
  $stmt= $dbconn->prepare("SELECT * FROM category WHERE category_id = :cat");

  $stmt->bindParam(":cat", $id);
  $stmt->execute();

  $cal = $stmt->fetch(PDO::FETCH_BOTH);
  extract($cal);
  return $category_name;
}

function getSubCategoryById($dbconn,$get){
  $stmt= $dbconn->prepare("SELECT * FROM sub_category WHERE hash_id = :cat");

  $stmt->bindParam(":cat", $get['id']);
  $stmt->execute();

  $cal = $stmt->fetch(PDO::FETCH_BOTH);
  extract($cal);
  return $sub_category_name;
}


function getProductNameById($dbconn,$get){
$id = getIdByHashId($dbconn,'product_id','product_id','product',$get['product_id']);

  $stmt= $dbconn->prepare("SELECT * FROM product WHERE product_id = :cat");

  $stmt->bindParam(":cat",$id);
  $stmt->execute();

  $cal = $stmt->fetch(PDO::FETCH_BOTH);
  extract($cal);

  return $product_name;

}



function deleteCategory($dbconn, $get){

$id = getIdByHashId($dbconn,'category_id','category_id','category',$get['id']);

  $stmt= $dbconn->prepare("DELETE FROM category WHERE category_id=:id");
  $stmt -> bindParam(":id", $id);
  $stmt->execute();

  $stmte= $dbconn->prepare("DELETE FROM sub_category WHERE category_id=:id");
  $stmte -> bindParam(":id", $id);
  $stmte->execute();
  header("Location: /product_category");

}

function deleteSubCategory($dbconn, $get){

  $stmt= $dbconn->prepare("DELETE FROM sub_category WHERE hash_id=:id");

  $stmt -> bindParam(":id", $get['id']);

  $stmt->execute();
  header("Location: /product_sub_category");

}



function deleteProduct($dbconn, $get){
$id = getIdByHashId($dbconn,'product_id','product_id','product',$get['product_id']);
  $stmt= $dbconn->prepare("DELETE FROM product WHERE product_id=:id");

  $stmt -> bindParam(":id", $id);
  $stmt->execute();
  header("Location: /products");
}


function uploadFiles($input, $name, $upDIR){
  $result = [];

  $rnd = rand(0000000, 9999999);
  $strip_name = str_replace(" ", "_", $input[$name]['name']);

  $filename= $rnd.$strip_name;
  $destination = $upDIR.$filename;

  if(!move_uploaded_file($input[$name]['tmp_name'], $destination)){
    $result[] = false;
  }else{
    $result[] = true;
    $result[] = $destination;
  }
  return $result;
}

function compressImage($files, $name, $quality,$upDIR ) {
  $rnd = rand(0000000, 9999999);
  $strip_name = str_replace(" ", "_", $_FILES[$name]['name']);

  $filename= $rnd.$strip_name;
  $destination_url = $upDIR.$filename;

  $info = getimagesize($files[$name]['tmp_name']);

    		if ($info['mime'] == 'image/jpeg')
        			$image = imagecreatefromjpeg($files[$name]['tmp_name']);

    		elseif ($info['mime'] == 'image/gif')
        			$image = imagecreatefromgif($files[$name]['tmp_name']);

   		elseif ($info['mime'] == 'image/png')
        			$image = imagecreatefrompng($files[$name]['tmp_name']);

    		imagejpeg($image, $destination_url, $quality);

  return $destination_url;
}


function getIdByHashId($dbconn,$id_name,$id,$table,$hash_id){
  $stmt = $dbconn->prepare("SELECT $id_name FROM $table WHERE hash_id = :hid ");
  $stmt->bindParam(":hid", $hash_id);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  return $row[$id_name];
}


function addProducts($dbconn,$post,$destination){

  $rnd = rand(000000000000,99999999999);
  $hash_id = 'product'.$rnd;
  $stmt = $dbconn->prepare("INSERT INTO product VALUES(NULL,:pname,:maker,:descr,:cat,:subcat,:av,:prost,:pr,:opr, :hid, :dest,:flg)");


  $data = [
    ':pname' => $post['product_name'],
    ':maker' => $post['maker'],
    ':descr' => $post['description'],
    ':cat' => $post['category'],
    ':subcat' => $post['sub_category'],
    ':av' => $post['availability'],
    ':prost' => $post['promo_status'],
    ':pr' => $post['price'],
    ':opr' => $post['old_price'],
    ':hid' => $hash_id,
    ':dest' => $destination,
    ':flg' => $post['flag']
  ];

  $stmt->execute($data);

  $success = "Product Successfully Added";
  $succ = preg_replace('/\s+/', '_', $success);

  header("Location:/add_products?success=$succ");
}

function getProductById($dbconn,$get){

$id = getIdByHashId($dbconn,'product_id','product_id','product',$get['product_id']);

  $stmt= $dbconn->prepare("SELECT * FROM product WHERE product_id = :cat");
  $stmt->bindParam(":cat", $id);
  $stmt->execute();
  $cal = $stmt->fetch(PDO::FETCH_BOTH);

    return $cal;
}





function editProducts($dbconn,$post,$get){
  $id = getIdByHashId($dbconn,'product_id','product_id','product',$get['product_id']);

  // die(var_dump($id));

  $stmt = $dbconn->prepare("UPDATE product SET product_name=:pname, maker=:maker, description=:descr,category=:cat,sub_category=:subcat, availability=:av, promo_status=:prost, price=:pr, old_price=:opr,  flag=:flg WHERE product_id =:id");

  $data = [
    ':pname' => $post['product_name'],
    ':maker' => $post['maker'],
    ':descr' => $post['description'],
    ':cat' => $post['category'],
    ':subcat' => $post['sub_category'],
    ':av' => $post['availability'],
    ':prost' => $post['promo_status'],
    ':pr' => $post['price'],
    ':opr' => $post['old_price'],
    ':flg' => $post['flag'],
    ':id' => $id
  ];

  $stmt->execute($data);
  $success = "Done";
  header("Location: /products?success=$success");
}

function doesUserEmailExist($dbconn, $input){ #placeholders are just there
  $result = false;

  $stmt = $dbconn -> prepare("SELECT * FROM users WHERE email = :em");
  $stmt->bindParam(":em",$input);
  $stmt->execute();
  $count = $stmt->rowCount();
  if($count>0){
    $result = true;
  }
  return $result;
}
function replaceImagePath($dbconn,$dest,$get){
  $id = getIdByHashId($dbconn,'product_id','product_id','product',$get['product_id']);

  // die(var_dump($id));
  $stmt = $dbconn->prepare("UPDATE product SET file_path=:des WHERE product_id =:id");
  $data = [
    ':id' => $id,
    ':des' => $dest
  ];
  $stmt->execute($data);
  $success = "Done";
  header("Location: /products?success=$success");
}



function doUserRegister($dbconn, $input, $hid){
  $hash = password_hash($input['pword'], PASSWORD_BCRYPT);


$stmt =$dbconn->prepare("INSERT INTO users(firstname,lastname,email,username,hash, hash_id) VALUES(:fname, :lname, :em, :uname, :h, :hid)");

  $stmt->bindParam(":fname", $input['fname']);
  $stmt->bindParam(":lname", $input['lname']);
  $stmt->bindParam(":em", $input['email']);
  $stmt->bindParam(":uname", $input['uname']);
  $stmt->bindParam(":h", $hash);
  $stmt->bindParam(":hid", $hid);

  $stmt->execute();

  $success= "Registration successful";
  $succ = preg_replace('/\s+/', '_', $success);
  header("Location:/users_registration?success=$succ");
}


function userLogin($dbconn, $input){
  $result = [];
  $stmt = $dbconn->prepare("SELECT * FROM users WHERE email = :e ");
  $stmt ->bindParam(":e", $input['email']);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  if($stmt->rowCount() > 0 && password_verify($input['hash'], $row['hash'])){
    extract($row);
    $_SESSION['username'] = $username;
    $_SESSION['id'] = $user_id;
    $_SESSION['email'] = $email;
    $_SESSION['fullname'] = $firstname." ".$lastname;
    $_SESSION['hash_id'] = $hash_id;
    
  }else{
    $mes = "Invalid Email or Password";
    $message = preg_replace('/\s+/', '_', $mes);
    header("Location:/user_login?msg=$message");
  }
}

function update_user($dbconn, $hid, $input){
  $stmt= $dbconn->prepare("UPDATE users SET hash_id = :hid WHERE email = :em");
  $data = [
        ':hid'=>$hid,
        ':em'=>$input['email'],
  ];
  $stmt->execute($data);
}

function bestSellingProduct($dbconn){
  $popular = "popular-demand";
  $stmt = $dbconn->prepare("SELECT * FROM product WHERE flag= :bs   ");
  $stmt->bindParam(":bs", $popular);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  return $row;

}

function trending($dbconn){
  $td = "trending";
  $stmt =$dbconn->prepare("SELECT * FROM product WHERE flag=:tr");
  $stmt->bindParam(":tr", $td);
  $stmt->execute();

  $result = "";

  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);

    $result = $result .
    "<li class='book' >".
    "<a href='/product_preview?product_id=".$product_id."'>".
    "<div class='book-cover' style=\"background:url('".$file_path."');".
    "background-size: cover; background-position: center; background-repeat: no-repeat;\">".
    "</div>".
    "</a>".
    "<div class='book-price'><p>$" .$price. "</p></div>".
    "</li>";
  }

  return $result;


}



function recentlyViewed($dbconn){
  $rvv = "top-selling";
  $stmt =$dbconn->prepare("SELECT * FROM product WHERE flag=:rv");
  $stmt->bindParam(":rv", $rvv);
  $stmt->execute();

  $result = "";

  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);

    $result = $result .
    "<li class='book' >".
    "<a href=/product_preview?product_id=".$product_id."'>".
    "<div class='book-cover' style=\"background:url('".$file_path."');".
    "background-size: cover; background-position: center; background-repeat: no-repeat;\">".
    "</div>".
    "</a>".
    "<div class='book-price'><p>$" .$price. "</p></div>".
    "</li>";
  }
  return $result;
}

function insertIntoReview($dbconn, $userID, $productID, $input){
  $stmt = $dbconn-> prepare("INSERT INTO review(user_id, product_id, review,date) VALUES(:us, :bk, :re, now())");
  $data = [
    ':us' => $userID,
    ':bk' => $productID,
    ':re' => $input['review']
  ];

  $stmt->execute($data);
}


function firstPreview($dbconn) {
  $stmt = $dbconn->prepare("SELECT * FROM category LIMIT 0, 1");
  $stmt->execute();

  return $stmt->fetch(PDO::FETCH_BOTH)[0];
}

function addToCart($dbconn, $userID, $productID, $file, $product, $productPrice, $input){
    $rnd = rand(000000000000,99999999999);
  $hash_id = 'cart'.$rnd;
  $stmt = $dbconn->prepare("INSERT INTO cart(quantity, hash_id, user_id, file_path, product_name, product_price, product_id) VALUES(:qu, :crt, :ui, :fp, :pn, :pp, :bi)");

  $data = [':qu'=> $input['quantity'],
  ':crt' => $hash_id,
  ':ui' => $userID,
  ':fp' => $file,
  ':pn' => $product,
  ':pp' => $productPrice,
  ':bi' => $productID,
  
];
$stmt->execute($data);
header("Location:cart?user_id=$userID");
}


function displayErrorsUser($dummy, $what) {
  $result = "";

  if(isset($dummy[$what])) {

    $result = '<p class="form-error">'. $dummy[$what]. '</p>';

  }
  return $result;
}
 function updateCart($dbconn, $input, $hid){
  $stmt = $dbconn->prepare("UPDATE cart SET user_id=:ui WHERE user_id= :hid");
  $stmt->bindParam(":ui", $input);
  $stmt->bindParam(":hid", $hid);
  $stmt->execute();
 }

#function for editing items in the cart
function editCart($dbconn, $cart){

  $stmt = $dbconn->prepare("UPDATE cart SET quantity=:qy WHERE cart_id=:ci");

  $data = [
    ':qy'=> $cart['qty'],
    ':ci'=> $cart['cartid']
  ];
  $stmt->execute($data);

  header("Location:/cart");
}

function culNav($page){

  $curPage = basename($_SERVER['SCRIPT_FILENAME']);

  if($curPage == $page) {
    echo 'class="selected"';
  }
}

function delCart($dbconn, $userID) {

  $stmt = $dbconn->prepare("DELETE FROM cart WHERE user_id=:uid");
  $stmt->bindParam(":uid", $userID);
  $stmt->execute();
}


function selectFromCart($dbconn, $userID){

  $stmt = $dbconn->prepare("SELECT * FROM cart WHERE user_id=:id");
  $stmt->bindParam(':id', $userID);
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);

echo    "<tr class='rem1'>
            <td class='invert'>".$cart_id."</td>
            <td class='invert-image'><a href='single.html'><img src=".$file_path." alt=".$product_name." class='img-responsive' /></a></td>
            <td class='invert'>
               <div class='quantity'>
                <input type='text' placeholder=".$quantity." name='quantity' size='3'>
                <input type='submit' value='Update' name='update' class='button' size='3'>

                </div>
              </div>
            </td>
            <td class='invert'>".$product_name."</td>

            <td class='invert'>#".$product_price."</td>
            <td class='invert'>
              <div class='rem'>
                <div class='close1'> </div>
              </div>
            </td>
          </tr>";
  }  
}
function selectCart($dbconn, $userID){

  $stmt = $dbconn->prepare("SELECT * FROM cart WHERE user_id=:id");
  $stmt->bindParam(':id', $userID);
  $stmt->execute();
  $row = $stmt->fetch(PDO::FETCH_BOTH);
    return $row;

  }




# function to view comment or review by a user
function ViewReview($dbconn, $productid) {

  $result = "";

  $stmt = $dbconn->prepare("SELECT * FROM review WHERE product_id=:bk");

  $stmt->bindParam(':bk', $productid);

  $stmt->execute();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    $statement = $dbconn->prepare("SELECT firstname, lastname FROM users WHERE user_id=:di");
    $statement->bindParam(":di", $row['user_id']);
    $statement->execute();
    $row1 = $statement->fetch(PDO::FETCH_ASSOC);
    $fname = $row1['firstname'];
    $lname = $row1['lastname'];
    $f = substr($fname, 0, 1);
    $l = substr($lname, 0, 1);
    $result .= '<li class="review">
    <div class="avatar-def user-image">
    <h4 class="user-init">'.$f.$l.'</h4>
    </div>
    <div class="info">
    <h4 class="username">'.$fname." ".$lname.'</h4>
    <p class="comment">'.$row['review'].'</p>
    </div>
    </li>';
  }
  return $result;
}
function viewpreviewProduct($dbconn, $hid){
  $stmt = $dbconn->prepare("SELECT * FROM product WHERE hash_id = :hid");
  $stmt->bindParam(":hid", $hid);
  $stmt -> execute();
  $row = $stmt->fetch(PDO::FETCH_BOTH);
  return $row;
}

function fetchPreviewProductroducts($dbconn, $hid){

  $stmt = $dbconn->prepare("SELECT * FROM product WHERE hash_id = :hid");
  $stmt->bindParam(":hid", $hid);
  $stmt -> execute();

  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
          extract($row);

  echo  "<div class='products'>
            <div class='container'>
              <div class='agileinfo_single'>

              <div class='col-md-4 agileinfo_single_left'>
                <img id='example' src=".$file_path." alt=".$product_name." class='img-responsive'>
              </div>
              <div class='col-md-8 agileinfo_single_right'>
              <h2>".$product_name." </h2>
                <div class='rating1'>
                  <span class='starRating'>
                    <input id='rating5' type='radio' name='rating' value='5'>
                    <label for='rating5'>5</label>
                    <input id='rating4' type='radio' name='rating' value='4'>
                    <label for='rating4'>4</label>
                    <input id='rating3' type='radio' name='rating' value='3' checked=''>
                    <label for='rating3'>3</label>
                    <input id='rating2' type='radio' name='rating' value='2'>
                    <label for='rating2'>2</label>
                    <input id='rating1' type='radio' name='rating' value='1'>
                    <label for='rating1'>1</label>
                  </span>
                </div>
                <div class='w3agile_description'>
                  <h4>Description :</h4>
                  <p>".$description.".</p>
                </div>
                <div class='snipcart-item block'>
                  <div class='snipcart-thumb agileinfo_single_right_snipcart'>
                    <h4 class='m-sing'># ".$price." <span># ".$old_price."</span></h4>
                  </div>
                  <div class='snipcart-details agileinfo_single_right_details'>";


          
  }

} 

function fetchSubCategory($dbconn,$cid){
  $stmt = $dbconn->prepare("SELECT * FROM sub_category WHERE category_id = $cid");

  $stmt->execute();

  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
     // $product = fetchProducts($dbconn, $sub_category_id);
    echo '<li><a href="/product?hid='.$sub_category_id.'"><i class="fa fa-arrow-right" aria-hidden="true"></i>'.$sub_category_name.'</a></li>';
    // var_dump($hash_id);
  }
}

  function fetchMainCategory($dbconn){
    $result = "";
    $stmt = $dbconn->prepare("SELECT * FROM category");
    $stmt->execute();
      while($row = $stmt->fetch(PDO::FETCH_BOTH)){
      extract($row);
        
    echo  "<li class='dropdown'>";
     echo "<a href='#' class='dropdown-toggle' data-toggle='dropdown'>".$category_name."<b class='caret'></b></a>
            <ul class='dropdown-menu multi-column columns-3'>
                      <div class='row'>
                        <div class='multi-gd-img'>
                          <ul class='multi-column-dropdown'>
                            <h6>".$category_name."</h6>";
                            fetchSubCategory($dbconn, $category_id);
       echo               "</ul>
                        </div>
                      </div>
                    </ul>
                </li>";
    }
    
  }

function fetchSideCategory($dbconn){
  $stmt = $dbconn->prepare("SELECT * FROM category");
  $stmt->execute();
  while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
    $categCount = count($category_id);
    for($i=0; $i<$categCount;$i++){
      echo '<li><a href="#"><i class="fa fa-arrow-right" aria-hidden="true"></i>'.$category_name.'</a></li>';
      echo '<ul>';
      fetchSubCategory($dbconn,$category_id);
      echo '</ul>';
    }
  }
}
function showAllProducts($dbconn){
   $result = " ";
    $stmt = $dbconn->prepare("SELECT * FROM product");
    $stmt -> execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
        extract($row);
          $result .=   "<div class='col-md-4 top_brand_left'>";
          $result .=   " <div class='hover14 column'>";
            $result .=     "<div class='agile_top_brand_left_grid'>";
            $result .=      "<div class=agile_top_brand_left_grid_pos>";
            $result .=     "<a href='preview?hid=".$hash_id."'><img src='images/offer.png' alt='' class='img-responsive'></a>
                            </div>
                           <div class='agile_top_brand_left_grid1'>
                             <figure>
                                <div class='snipcart-item block'>
                                  <div class='snipcart-thumb'> 
                                   <img src=".$file_path." alt='' class='img-responsive'>
                                    <p>".$product_name."</p>
                                    <h4># ".$price." <span># ".$old_price."</span></h4>
                                </div>
                              <div class='snipcart-details top_brand_home_details'>
                              <a href='preview?hid=".$hash_id."'><input type='submit' name='submit' value='Preview' class='button'></a>
                                  </div>
                                </div>
                              </figure>
                            </div>
                          </div>
                        </div>
                      </div>";
                }
              return $result;
        }

function showProducts($dbconn, $hid){
    $result = " ";
    $stmt = $dbconn->prepare("SELECT * FROM product WHERE sub_category = :hid");
    $stmt ->bindParam(":hid", $hid);
    $stmt -> execute();
    while($row = $stmt->fetch(PDO::FETCH_BOTH)){
        extract($row);
          $result .=   "<div class='col-md-4 top_brand_left'>";
          $result .=   " <div class='hover14 column'>";
          $result .=     "<div class='agile_top_brand_left_grid'>";
          $result .=      "<div class=agile_top_brand_left_grid_pos>";
          $result .= "<a href='preview?hid=".$hash_id."'><img src='images/offer.png' alt=".$product_name."  
                        class='img-responsive'></a>
                            </div>
                           <div class='agile_top_brand_left_grid1'>
                             <figure>
                                <div class='snipcart-item block'>
                                  <div class='snipcart-thumb'> 
                                   <img src=".$file_path." alt='' class='img-responsive'>
                                    <p>".$product_name."</p>
                                    <h4># ".$price." <span># ".$old_price."</span></h4>
                                </div>
                              <div class='snipcart-details top_brand_home_details'>
                              <a href='preview?hid=".$hash_id."'><input type='submit' name='submit' value='Preview' class='button'></a>
                                  </div>
                                </div>
                              </figure>
                            </div>
                          </div>
                        </div>
                      </div>";


    }
    return $result;
    
}
function getProductsFromCart($dbconn, $userID){
  $result = " ";
  $stmt = $dbconn->prepare("SELECT * FROM cart WHERE user_id = :uid");
  $stmt->bindParam(":uid", $userID);
  $stmt->execute();
  while ($row = $stmt->fetch(PDO::FETCH_BOTH)){
    extract($row);
    //$result = implode(" ", $row);
    $result .= "<p>".$product_name.", ".$file_path.", #".$product_price.", ".$product_id."</p>";
    /*$count_result = count($result);
    if($count_result < 0){
      header("Location:home");
    }*/
    
}
return $result;

}



function addCheckout($dbconn, $userID, $input){
  //Invocked get product from cart
   $result = getProductsFromCart($dbconn, $userID);
  $stmt = $dbconn->prepare("INSERT INTO checkout(name, phone_number, adress, product_info, user_id, date_added) VALUES(:na, :ph, :ad, :pi, :uid, NOW())");
      $data = [
        ':na' => $input['fname'],
        ':ph' => $input['pnumber'],
        ':ad' => $input['adress'],
        ':pi' => $result,
        ':uid' =>$userID,
      ];
      var_dump($data);
      $stmt->execute($data);
      $user_id = $userID;
      header("Location:comfirmation?user_id=$user_id");
  }


  

function displayCheckout($dbconn, $userID){
  $total_price = 0;
    $stmt = $dbconn->prepare("SELECT * FROM cart WHERE user_id = :uid");
  $stmt->bindParam(":uid", $userID);
  $stmt->execute();
  while($result = $stmt->fetch(PDO::FETCH_BOTH)){
   
    extract($result);
    $total_price += $product_price;
    $product_count = count($product_price);
    for ($i=0; $i < $product_count ; $i++) { 

      echo "<li>".$product_name." <i>-</i> <span>#".$product_price." </span></li>";
            
    }

  }
  echo "<li><h5>Total <i>-</i> <span>#".$total_price."</span></h5></li>";
}







?>
