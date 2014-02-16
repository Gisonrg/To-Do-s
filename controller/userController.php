<?php


function check_login() {
	if (isset($_SESSION['valid_user_id'])) {
		return false;
	} else {
		return true;
	}
}



?>