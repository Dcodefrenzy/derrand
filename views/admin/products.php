<?php
ob_start();
session_start();
authenticate();

$_SESSION['active'] = true;
$page_title = "View Products";
$link= "products";

include 'include/header2.php';
 ?>
 <table id="tab">
   <thead>
     <tr>
       <th>Description</th>
       <th>Product id</th>
       <th>Product Name</th>
       <th>Producer</th>
       <th>Category</th>
       <th>Sub-Category</th>
       <th>Price</th>
       <th>Old Price</th>
       <th>Availability</th>
       <th>Promo Status</th>
       <th>Image</th>
       <th>Flag</th>
     </tr>
   </thead>
   <tbody>
     <?php

     viewProducts($conn);
     ?>

         </tbody>
 </table>
         </tbody>
 </table>

<br>
<br>
<br>
<br>
 <?php include 'include/footer.php'; ?>
