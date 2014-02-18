<?php
require_once("config/config.inc");
session_save_path(SESSION_SAVED);
session_start();

require_once("model/db.php");
require_once("model/user.php");

//set highlight item in the navigation bar
$_SESSION['active']='Account';

if (!isset($_SESSION['valid_user_id'])) {
	header("Refresh: 0; url=index(new).php");
	exit;	
} 

// pull the user information from the database
$row = retrieve_user_info($_SESSION['valid_user_id']);

$er_msg = "";
$su_msg = "";

if (isset($_REQUEST['submit']) && ($_REQUEST['submit'] == "Update")) {
	if (isset($_POST['o_password']) && isset($_POST['n_password']) && trim($_POST['o_password'])!='' &&trim($_POST['o_password'])!='') {
		if (user_authenticate($_POST['name'], sha1($_POST['o_password']))>=0) {
			if (update_user($_POST['name'], $_POST['email'],$_SESSION['valid_user_id'], sha1($_POST['n_password']))) {
				$su_msg= "Update successfully!<br/>Reloading...";
				$row = retrieve_user_info($_SESSION['valid_user_id']);
			} else {
				$er_msg= "Update unsuccessfully! Please try again";
			}
		} else {
			$er_msg = "Wrong password! Please try again";
		}
	} else {
		if (update_user($_POST['name'], $_POST['email'],$_SESSION['valid_user_id'])) {
			$su_msg= "Update successfully!<br/>Reloading...";
			$row = retrieve_user_info($_SESSION['valid_user_id']);
		} else {
			$er_msg = "Update unsuccessfully! Please try again";
		}
	}
}


require('view/account.view.php');




?>