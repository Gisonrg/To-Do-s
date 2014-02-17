<?php
require_once("config/config.inc");
session_save_path(SESSION_SAVED);
session_start();

require_once("model/db.php");
require_once("model/user.php");
require_once("controller/userController.php");
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
	echo $_POST['name'];
		if (isset($_POST['o_password']) && isset($_POST['n_password']) && trim($_POST['o_password'])!='' &&trim($_POST['o_password'])!='') {
			if (user_authenticate($_POST['name'], sha1($_POST['o_password']))>=0) {
				if (update_user($_POST['name'], $_POST['email'],$_SESSION['valid_user_id'], sha1($_POST['n_password']))) {
					echo "Update successfully!";
				} else {
					echo "Error: Update unsuccessfully! Please try again1";
					$_SESSION['mode'] = 'show';
					display_user_information($_SESSION['valid_user_id']);
				}
			} else {
				// echo $register_result;
				echo "<p id=\"warning\">Error: Wrong old password! Please try again2</p>";
				$_SESSION['mode'] = 'show';
				display_user_information($_SESSION['valid_user_id']);
			}
		} else {
			if (update_user($_POST['name'], $_POST['email'],$_SESSION['valid_user_id'])) {
				echo "Update successfully!";
			} else {
				echo "Error: Update unsuccessfully! Please try again3";
				$_SESSION['mode'] = 'show';
				display_user_information($_SESSION['valid_user_id']);
			}
		}
		break;
	case 'access_denied':
		echo "Please login to see the page!";
		header("Refresh: 3; url=login.php");
		break;
	default:
		# code...
		break;
}


echo "</div>";








showFooter();

?>