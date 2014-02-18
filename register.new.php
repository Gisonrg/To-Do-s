<?php
require_once("config/config.inc");
session_save_path(SESSION_SAVED);
session_start();

require_once("model/db.php");


//set highlight item in the navigation bar
$_SESSION['active']='Sign Up';

$username="";
$email ="";
$msg="";

if (isset($_SESSION['valid_user_id'])) {
	header("Refresh: 0; url=index(new).php");
	exit;
	
} else if (isset($_POST['submit']) && $_POST['submit'] =='Sign Up') {

	$register_result = user_register(trim($_POST['name']),sha1($_POST['password']),trim($_POST['email']));

	if ($register_result  >= 0) {

		$_SESSION['valid_user_id'] = $register_result;

		header("Refresh: 0; url=index(new).php");
		exit;

	} else {
		$username=$_POST['name'];
		$email =$_POST['email'];
		if ($register_result==-1) {
			$msg = "Register unsuccessfully! Please try again :(";
		} else {
			$msg = "Register unsuccessfully!<br/>Your username or email has already been registered!<br/>Please try again :(";
		}
	}
}


require('view/register.view.php');




?>