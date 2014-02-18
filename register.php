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

echo "<div class=\"full-page\">";

switch ($_SESSION['mode']) {
	case 'register':
		require("view/register.inc");
		break;
	case 'register_result':
		if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
			
			$register_result = user_register(trim($_POST['name']),sha1($_POST['password']),trim($_POST['email']));
			
			if ($register_result>=0) {
				$_SESSION['valid_user_id'] = $register_result;
				$msg = "Login successfully!<br/>You have now logged in as <strong>".$_POST['name']."</strong>.<br/>";
				$msg = $msg."You are now being redirect to the homepage...";
				display_success($msg);
				event_new_user($register_result);
				header("Refresh: 3; url=index.php");
			} else {
				if ($register_result==-1) {
					$msg = "Register unsuccessfully! Please try again :(";
				} else {
					$msg = "Register unsuccessfully!<br/>Your username or email has already been registered!<br/>Please try again :(";
				}
				display_error($msg);
				$_SESSION['mode'] = 'register';
				require("view/register.inc");
			}
		}
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