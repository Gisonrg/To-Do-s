<?php
require_once("config/config.inc");
session_save_path(SESSION_SAVED);
session_start();

require_once("model/db.php");
require_once("controller/userController.php");
require("view/header.inc");
require("view/footer.inc");



//default mode 
$_SESSION['mode'] = 'register';
//check if user has login
if (isset($_SESSION['valid_user_id'])) {
	$_SESSION['mode'] = 'access_denied';
}

//switch mode to register result
if (isset($_POST['submit']) && $_POST['submit'] =='Submit') {
	$_SESSION['mode'] = 'register_result';
}

showHeader("Register");

switch ($_SESSION['mode']) {
	case 'register':
		require("view/register.inc");
		break;
	case 'register_result':
		if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
			$register_result = user_register($_POST['name'],sha1($_POST['password']),$_POST['email']);
			if ($register_result) {
				$_SESSION['valid_user_id'] = $register_result;
				echo "Register successfully! You have now logged in as ".$_POST['name'];
			} else {
				echo "Error: Register unsuccessfully! Please try again";
				$_SESSION['mode'] = 'register';
				require("view/register.inc");
			}
		}
		break;
	case 'access_denied':
		echo "You have already logged in!";
		header('Location: index.php');
		break;
	default:
		# code...
		break;
}







showFooter();




?>