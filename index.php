<?php 
require_once("config/config.inc");
require_once("model/db.php");
require_once("controller/userController.php");
require("view/header.inc");
require("view/footer.inc");
// session_save_path(SESSION_SAVED);
session_start();

$_SESSION['userID'] = 1;

showHeader("Home Page");











showFooter();
?>

