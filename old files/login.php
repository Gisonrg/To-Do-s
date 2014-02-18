<?php
require_once("config/config.inc");
session_save_path(SESSION_SAVED);
session_start();

require_once("model/db.php");
require_once("controller/userController.php");
require_once("controller/messageController.php");
require("view/header.inc");
require("view/footer.inc");




//default mode 
$_SESSION['mode'] = 'login';
//check if user has login
if (isset($_SESSION['valid_user_id'])) {
	$_SESSION['mode'] = 'access_denied';
}

//switch mode to login result
if (isset($_POST['submit']) && $_POST['submit'] =='login') {
	$_SESSION['mode'] = 'login_result';
}

showHeader("Login");
echo "<div class=\"full-page\">";

switch ($_SESSION['mode']) {
	case 'login':
		require('view/login.inc');
		break;
	case 'login_result':
		require('view/login_result.php');
		break;
	case 'access_denied':
		header("url=index.php");
		break;
	default:
		break;
}

echo "</div>";






showFooter();











?>