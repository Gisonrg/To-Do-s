<?php 
require_once("config/config.inc");
session_save_path(SESSION_SAVED);
session_start();
require_once("model/db.php");
require_once("controller/userController.php");
require("view/header.inc");
require("view/footer.inc");



showHeader("Home Page");











showFooter();
?>

