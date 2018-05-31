<?php
#Define App Path
define("APP_PATH", dirname(dirname(__FILE__)));


#load database
#load Controllers(functions)
require APP_PATH."/controller/controller.php";

#load routes
require APP_PATH."/routes/router.php";

 ?>
