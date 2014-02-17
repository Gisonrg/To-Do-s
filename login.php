<?php
require_once("config/config.inc");
session_save_path(SESSION_SAVED);
session_start();

require_once("model/db.php");
require_once("controller/userController.php");
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

switch ($_SESSION['mode']) {
	case 'login':
		require('view/login.inc');
		break;
	case 'login_result':
		if (isset($_POST['name']) && isset($_POST['password'])) {
			$register_result = user_authenticate($_POST['name'], sha1($_POST['password']));
			if ($register_result >= 0) {
				$_SESSION['valid_user_id'] = $register_result;
				echo "Login successfully! \nYou have now logged in as ".$_POST['name'];
				echo "\nYou are now being redirect to the homepage...";
				header("Refresh: 3; url=index.php");
			} else {
				// echo $register_result;
				echo "Error: Login unsuccessfully! Please try again";
				$_SESSION['mode'] = 'login';
				require('view/login.inc');
			}
		}
		break;
	case 'access_denied':
		echo "You have already logged in!";
		break;
	default:
		# code...
		break;
}








showFooter();











?>