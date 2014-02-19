<!--contact.php-->
<?php 
	require_once("config/config.inc");
	session_save_path(SESSION_SAVED);
	session_start();

	require_once("model/db.php");
	require_once("model/user.php");
	require_once("model/task.php");
	require_once("model/event.php");

	//set highlight item in the navigation bar
	$_SESSION['active']='About';

	require('view/contact.view.php');
?>


