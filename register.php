<?php
require_once("config/config.inc");
require_once("model/db.php");
require_once("controller/userController.php");
require("view/header.inc");
require("view/footer.inc");
session_save_path('SESSION_SAVED');
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


switch ($_SESSION['mode']) {
	case 'register':
		require("view/register.inc");
		break;
	case 'register_result':
		if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
			
		}


		break;
	default:
		# code...
		break;
}

showHeader("Home Page");




require("view/register.inc");






showFooter();




?>