<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");
 
// include main configuration file
require_once PROJECT_ROOT_PATH . "/inc/config.php";
 
// include the base controller file
require_once PROJECT_ROOT_PATH . "/Controller/Api/BaseController.php";
 
// include the user model file
require_once PROJECT_ROOT_PATH . "/Model/UserModel.php";

// include the parcela model file
require_once PROJECT_ROOT_PATH . "/Model/ParcelaModel.php";

// include the sonda model file
require_once PROJECT_ROOT_PATH . "/Model/SondaModel.php";
?>