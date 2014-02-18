<?php 
require_once("config/config.inc");
session_save_path(SESSION_SAVED);
session_start();
require_once("model/db.php");


require_once("view/task.inc");

//set highlight item in the navigation bar
$_SESSION['active']='Home';

$events = retrieve_current_events();

if (isset($_SESSION['valid_user_id'])) {

	//detect user do task
	if (isset($_REQUEST['submit']) && ($_REQUEST['submit'] == "do")) {
		$row = retrieve_task_info($_REQUEST['taskid']);
		do_task($_REQUEST['taskid'], $row['remainingslot'] - 1);
	}

	//reload for display
	$row = retrieve_user_info($_SESSION['valid_user_id']);
	$tasks = retrieve_ongoing_tasks_info($_SESSION['valid_user_id']);

	require('view/home.view.php');
} else {
	require('view/index.view.php');
}





?>
