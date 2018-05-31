<?php




$stmt = $econn->prepare("SELECT * FROM sub_category WHERE category_id = :cid");
$stmt->bindParam(":cid", $_POST['child']);
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_BOTH)){
  extract($row);
echo '<li><a href="products.html"><i class="fa fa-arrow-right" aria-hidden="true"></i>'.$sub_category_name.'</a></li>';
}

 ?>
