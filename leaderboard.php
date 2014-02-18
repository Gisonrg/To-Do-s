<!--leaderboard.php-->
<?php 
	require_once("config/config.inc");
	session_save_path(SESSION_SAVED);
	session_start();

	require_once("model/db.php");
	require_once("controller/userController.php");
	require("view/task.inc");
	require("view/header.inc");
	require("view/footer.inc");

	showHeader("Tasks");
	if (isset($_SESSION['valid_user_id'])) {
    	showBar($_SESSION['valid_user_id']);
	}
	require("view/leaderboard.inc");
	showFooter();
?>