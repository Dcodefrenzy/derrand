<?php
ob_start();
session_start();
authenticate();
$_SESSION['active'] = true;

$page_title = "Admin Home";
$link= "admin_home";

#$deci = $_SESSION['id'];
if(isset($_SESSION['admin_name'])){
  $deb = $_SESSION['admin_name'];
}

#$def = $_SESSION['id'];

include 'include/header2.php';



?>
<div class="wrapper">
  <h1 id="register-label"></h1>
  <hr>

  <div id="stream">
    <?php $made = ucwords($deb); echo "<p>Welcome, <strong>$made</strong></p>"?>
  </div>
</div>

<?php include 'include/footer.php'; ?>
