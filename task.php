<!--task.php-->
<?php 
	require_once("config/config.inc");
	session_save_path(SESSION_SAVED);
	session_start();

	require_once("model/db.php");
	require_once("controller/userController.php");
	require("view/task.inc");
	require("view/header.inc");
	require("view/footer.inc");

	if (!isset($_SESSION['valid_user_id'])) {
		echo "you didn't login";
		header("Refresh: 3; url=login.php");
	} else {
		showHeader("Tasks");
		show_existing_task($_SESSION['valid_user_id']);
		showFooter();
	}
?>