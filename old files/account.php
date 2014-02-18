<?php
require_once("config/config.inc");
session_save_path(SESSION_SAVED);
session_start();

require_once("model/db.php");
require_once("model/user.php");
require_once("controller/userController.php");
require_once("controller/messageController.php");
require("view/header.inc");
require("view/footer.inc");


showHeader("Manage My Account");
if (isset($_SESSION['valid_user_id'])) {
    showBar($_SESSION['valid_user_id']);
}
//default mode 
$_SESSION['mode'] = 'show';
//check if user has login
if (!isset($_SESSION['valid_user_id'])) {
	$_SESSION['mode'] = 'access_denied';
}

//switch mode to login result
if (isset($_POST['submit']) && $_POST['submit'] =='Update') {
	$_SESSION['mode'] = 'update_result';
}



echo "<div class=\"content\">";

switch ($_SESSION['mode']) {
	case 'show':
		display_user_information($_SESSION['valid_user_id']);
		break;

	case 'update_result':
		if (isset($_POST['o_password']) && isset($_POST['n_password']) && trim($_POST['o_password'])!='' &&trim($_POST['o_password'])!='') {
			if (user_authenticate($_POST['name'], sha1($_POST['o_password']))>=0) {
				if (update_user($_POST['name'], $_POST['email'],$_SESSION['valid_user_id'], sha1($_POST['n_password']))) {
					$msg= "Update successfully!";
					display_success($msg);
					header("Refresh: 3; url=index.php");
				} else {
					$msg= "Update unsuccessfully! Please try again";
					display_error($msg);
					$_SESSION['mode'] = 'show';
					display_user_information($_SESSION['valid_user_id']);
				}
			} else {
				$msg = "Wrong old password! Please try again";
				display_error($msg);
				$_SESSION['mode'] = 'show';
				display_user_information($_SESSION['valid_user_id']);
			}
		} else {
			if (update_user($_POST['name'], $_POST['email'],$_SESSION['valid_user_id'])) {
				$msg= "Update successfully!";
				display_success($msg);
				header("Refresh: 3; url=index.php");
			} else {
				$msg = "Update unsuccessfully! Please try again";
				display_error($msg);
				$_SESSION['mode'] = 'show';
				display_user_information($_SESSION['valid_user_id']);
			}
		}
		break;
	case 'access_denied':
		$msg= "Please login to see the page!";
		display_error($msg);
		header("Refresh: 3; url=login.php");
		break;
	default:
		# code...
		break;
}


echo "</div>";








showFooter();

?>