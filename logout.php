<!--logout.php-->
<?php
	require_once("config/config.inc");
	session_save_path(SESSION_SAVED);
	session_start();
	require_once("model/db.php");
	require_once("model/user.php");
	require_once("model/task.php");
	require_once("model/event.php");
	$_SESSION['active']='Logout';
	if (!isset($_SESSION['valid_user_id'])) {
		header("Refresh: 0; url=index.php");
		exit;
	}
	$su_msg = "You have successfully logged out!<br/>Thanks for using me!";
	unset($_SESSION['valid_user_id']);
	require('view/logout.view.php');
	header("Refresh: 3; url=index.php");
?>