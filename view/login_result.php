<!--login_result.php-->
<?php
	require_once("model/db.php");
	require_once("controller/userController.php");
	require_once("controller/messageController.php");
	if (isset($_POST['name']) && isset($_POST['password'])) {
		$register_result = user_authenticate($_POST['name'], sha1($_POST['password']));
		if ($register_result >= 0) {
			$_SESSION['valid_user_id'] = $register_result;
			$msg = "Login successfully!<br/>You have now logged in as <strong>".$_POST['name']."</strong>.<br/>";
			$msg = $msg."You are now being redirect to the homepage...";
			display_success($msg);
			header("Refresh: 3; url=index.php");
		} else {
			// echo $register_result;
			$msg = "Login unsuccessfully! Please try again";
			display_error($msg);
			$_SESSION['mode'] = 'login';
			require('view/login.inc');
		}
	}
?>