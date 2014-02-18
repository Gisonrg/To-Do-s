<?php
require_once("config/config.inc");
session_save_path(SESSION_SAVED);
session_start();

require_once("model/db.php");


//set highlight item in the navigation bar
$_SESSION['active']='Login';

$username="";
$msg="";

if (isset($_SESSION['valid_user_id'])) {
	header("Refresh: 0; url=index(new).php");
	exit;
} else if (isset($_POST['submit']) && $_POST['submit'] =='Login') {

	$login_result = user_authenticate($_POST['name'], sha1($_POST['password']));

	if ($login_result  >= 0) {
		$_SESSION['valid_user_id'] = $login_result;
		header("Refresh: 0; url=index(new).php");
		exit;
	} else {
		$username=$_POST['name'];
		$msg = "Login unsuccessfully! Please try again";
	}
}


require('view/login.view.php');



?>