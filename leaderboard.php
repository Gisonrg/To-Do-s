<!--leaderboard.php-->
<?php 
	require_once("config/config.inc");
	session_save_path(SESSION_SAVED);
	session_start();

	require_once("model/db.php");
	require_once("model/user.php");
	require_once("model/task.php");
	require_once("model/event.php");

	//set highlight item in the navigation bar
	$_SESSION['active']='Leaderboard';

	//load user information
	$row = retrieve_user_info($_SESSION['valid_user_id']);
	$tasks = retrieve_ongoing_tasks_info($_SESSION['valid_user_id']);

	//only valid user can visit the file
	if (isset($_SESSION['valid_user_id'])) {
		$leaders = retrieve_leader_info();
		require('view/leaderboard.view.php');
	} else {
		header("Refresh: 0; url=index.php");
	}
?>

