<?php
    define("DBNAME", 'ecommerce');
    define("DBUSER", 'root');
    define("DBPASS", 'koda');

        try{

          $lconn = new PDO('mysql:host=localhost;dbname='.DBNAME, DBUSER, DBPASS);

          $lconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
        }
        catch(PDOException $e) {
                echo $e->getMessage();
        }


        $stmt = $lconn->prepare("SELECT * FROM sub_category WHERE category_id = :cat_id");
        $stmt->bindParam(":cat_id", $_POST['cat_id']);
        $stmt->execute();
          echo  '<option value="">-Select Sub Category-</option>';
        while($row = $stmt->fetch(PDO::FETCH_BOTH)){

          echo '<option value="'.$row['sub_category_id'].'">'.$row['sub_category_name'].'</option>';

        }




 ?>
