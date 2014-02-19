<?php
require_once("config/config.inc");
session_save_path(SESSION_SAVED);
session_start();

require_once("model/db.php");
require_once("model/user.php");
require_once("model/task.php");
require_once("model/event.php");

//set highlight item in the navigation bar
$_SESSION['active']='Task';

if (!isset($_SESSION['valid_user_id'])) {
	header("Refresh: 0; url=index.php");
	exit;	
} 


$er_msg = "";
$su_msg = "";

// // pull the user information from the database
$row = retrieve_user_info($_SESSION['valid_user_id']);
$tasks = retrieve_tasks_info($_SESSION['valid_user_id']);

//do a task
//detect user do task
if (isset($_REQUEST['submit']) && ($_REQUEST['submit'] == "Do")) {
	$row = retrieve_task_info($_REQUEST['taskid']);
	do_task($_REQUEST['taskid'], $row['remainingslot'] - 1);
}
//reload for display
$row = retrieve_user_info($_SESSION['valid_user_id']);
$tasks = retrieve_tasks_info($_SESSION['valid_user_id']);


// Create a task 
if (isset($_REQUEST['submit']) && $_REQUEST['submit'] =='Create') {
	if (add_task($_SESSION['valid_user_id'], $_REQUEST['title'], $_REQUEST['description'], $_REQUEST['duration'])) {
		$su_msg = "Create successfully!<br/>Reloading...";
		$tasks = retrieve_tasks_info($_SESSION['valid_user_id']);
		$_REQUEST['mode'] = 'create';
	} else {
		$er_msg = "Error!";
	}
}

if (isset($_REQUEST['mode']) && $_REQUEST['mode'] =='create') {
	require('view/task_create.view.php');
	exit();
}

//updating a task
if ((isset($_REQUEST['task_id'])) && isset($_REQUEST['mode'])  && $_REQUEST['mode']=="edit" ) {
	if (isset($_REQUEST['submit']) && ($_REQUEST['submit'] == "Update")) {
		$row = retrieve_task_info($_REQUEST['task_id']);
		if (update_task($_REQUEST['task_id'], $_REQUEST['title'], $_REQUEST['description'], $_REQUEST['duration'], $row['remainingslot'] + $_REQUEST['duration'] - $row['totalslot'])){
			$su_msg = "Update successfully!<br/>Reloading...";
		} else {
			$er_msg = "Error!";
		}
	}
	$task = retrieve_task_info($_REQUEST['task_id']);
	require('view/task_edit.view.php');
	exit();
}

require('view/task.view.php');


?>