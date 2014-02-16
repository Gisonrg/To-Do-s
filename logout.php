<!--logout.php-->
<?php
	require_once("config/config.inc");
	session_save_path(SESSION_SAVED);
	session_start();
	unset($_SESSION['valid_user_id']);
	header('Location: index.php');
?>