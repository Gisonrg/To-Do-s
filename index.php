<?php 
require_once("config/config.inc");
session_save_path(SESSION_SAVED);
session_start();
require_once("model/db.php");
require_once("controller/userController.php");
require("view/header.inc");
require("view/footer.inc");
require_once("view/task.inc");


showHeader("Home Page");
if (isset($_SESSION['valid_user_id'])) {
    showBar($_SESSION['valid_user_id']);
}
echo "<div class=\"content\">";

if (isset($_SESSION['valid_user_id'])) {
    show_existing_task($_SESSION['valid_user_id']);
}



echo "</div>";









showFooter();
?>

