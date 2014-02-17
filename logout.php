<!--logout.php-->
<?php
	require_once("config/config.inc");
	session_save_path(SESSION_SAVED);
	session_start();
	require_once("model/db.php");
	require_once("controller/userController.php");
	require_once("controller/messageController.php");
	require("view/header.inc");
	require("view/footer.inc");
	require_once("view/task.inc");


	showHeader("Logging Out...");
	//if log on, log out
	//else, header to the index
	if (isset($_SESSION['valid_user_id'])) {
		$_SESSION['mode'] = 'logout';
	} else {
		$_SESSION['mode'] = 'access_denied';
	}

	echo "<div class=\"full-page\">";

	switch ($_SESSION['mode']) {
		case 'logout':
			unset($_SESSION['valid_user_id']);
			$msg = "You have successfully logged out!";
			display_success($msg);
			header("Refresh: 3; url=index.php");
			break;
		case 'access_denied':
			header('Location: index.php');
			break;
		default:
			# code...
			break;
	}

	echo "</div>";

showFooter();

?>