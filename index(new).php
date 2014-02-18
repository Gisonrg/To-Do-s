<?php 
require_once("config/config.inc");
session_save_path(SESSION_SAVED);
session_start();
require_once("model/db.php");


require_once("view/task.inc");

//set highlight item in the navigation bar
$_SESSION['active']='Home';

require('view/index.view.php');


?>

