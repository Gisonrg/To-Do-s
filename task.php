<?php
require_once("./config/config.inc");
session_save_path(SESSION_SAVED);
session_start();

require_once("model/db.php");
require_once("model/user.php");
require_once("model/task.php");
require_once("model/event.php");

//set highlight item in the navigation bar
$_SESSION['active']='Task';

//only valid user can see this page
if (!isset($_SESSION['valid_user_id'])) {
	header("Refresh: 0; url=login.php");
	exit;	
} 

//prepare success and error message
$er_msg = "";
$su_msg = "";
//prepare task
$task = array('title'=>'', 'description'=>'', 'totalslot'=>'');

// // pull the user information from the database
$row = retrieve_user_info($_SESSION['valid_user_id']);
$tasks = retrieve_tasks_info($_SESSION['valid_user_id']);

// show require task
if (isset($_REQUEST['submit']) && isset($_REQUEST['mode']) && $_REQUEST['mode']=='show') {
	if (isset($_REQUEST['submit']) && $_REQUEST['submit'] =='Show Ongoing') {
		$tasks = retrieve_ongoing_tasks_info($_SESSION['valid_user_id']);
	} else if (isset($_REQUEST['submit']) && $_REQUEST['submit'] =='Show Past') {
		$tasks = retrieve_past_tasks_info($_SESSION['valid_user_id']);
	} else {
		$tasks = retrieve_tasks_info($_SESSION['valid_user_id']);
	}
}

//detect user do task
if (isset($_REQUEST['submit']) && ($_REQUEST['submit'] == "Do")) {
	//do a task
	$row = retrieve_task_info($_REQUEST['taskid']);
	do_task($_REQUEST['taskid'], $row['remainingslot'] - 1);
	unset($_REQUEST['submit']);

	//reload for display
	$row = retrieve_user_info($_SESSION['valid_user_id']);
	$tasks = retrieve_tasks_info($_SESSION['valid_user_id']);
}


// Create a task 
if (isset($_REQUEST['submit']) && $_REQUEST['submit'] =='Create') {
	if (is_numeric($_REQUEST['duration']) && ($_REQUEST['duration']>=1 && $_REQUEST['duration']<=20)) {
		if (add_task($_SESSION['valid_user_id'], $_REQUEST['title'], $_REQUEST['description'], $_REQUEST['duration'])) {
			$su_msg = "Create successfully!<br/>Reloading...";
			$tasks = retrieve_tasks_info($_SESSION['valid_user_id']);
			$_REQUEST['mode'] = 'create';
		} else {
			$er_msg = "Error connect to the database!";
		}
	} else {
		$er_msg = "Please enter an valid number bewteen 1 and 20 for the time slot.";
		$task = array('title'=>$_REQUEST['title'], 'description'=>$_REQUEST['description'], 'totalslot'=>$_REQUEST['duration']);
		require('view/task_create.view.php');
		exit();
	}
}

if (isset($_REQUEST['mode']) && $_REQUEST['mode'] =='create') {
	require('view/task_create.view.php');
	exit();
}

//updating a task
if ((isset($_REQUEST['task_id'])) && isset($_REQUEST['mode'])  && $_REQUEST['mode']=="edit" ) {
	if (isset($_REQUEST['submit']) && ($_REQUEST['submit'] == "Update")) {
		if (is_numeric($_REQUEST['duration']) && ($_REQUEST['duration']>=1 && $_REQUEST['duration']<=20)) {
			$row = retrieve_task_info($_REQUEST['task_id']);
			if (update_task($_REQUEST['task_id'], $_REQUEST['title'], $_REQUEST['description'], $_REQUEST['duration'], $row['remainingslot'] + $_REQUEST['duration'] - $row['totalslot'])){
				$su_msg = "Update successfully!<br/>Reloading...";
			} else {
				$er_msg = "Error connect to the database!";
			}
		} else {
			$er_msg = "Please enter an valid number bewteen 1 and 20 for the time slot.";
		}
	}
	$task = retrieve_task_info($_REQUEST['task_id']);
	$row = retrieve_user_info($_SESSION['valid_user_id']);
	require('view/task_edit.view.php');
	exit();
}


require('view/task.view.php');


?>