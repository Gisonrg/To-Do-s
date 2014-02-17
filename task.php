<!--task.php-->
<?php 
	require_once("config/config.inc");
	session_save_path(SESSION_SAVED);
	session_start();

	require_once("model/db.php");
	require_once("controller/userController.php");
	require("view/task.inc");
	require("view/header.inc");
	require("view/footer.inc");

	// default mode 
	$_SESSION['mode'] = 'view';
	// creating mode
	if ((isset($_REQUEST['mode'])) && ($_REQUEST['mode'] == 'create')) {
		$_SESSION['mode'] = 'create';
	}
	// creating mode
	if ((isset($_REQUEST['task_id'])) && (varify_user_and_task($userid, $taskid))) {
		$_SESSION['mode'] = 'edit';
	}
	// inserting mode
	if (isset($_POST['submit']) && $_POST['submit'] =='create') {
		$_SESSION['mode'] = 'insert';
	}

	showHeader("Tasks");
	if (isset($_SESSION['valid_user_id'])) {
    	showBar($_SESSION['valid_user_id']);
	}
	switch ($_SESSION['mode']) {
		case 'view':
			if (!isset($_SESSION['valid_user_id'])) {
				echo "you didn't login";
				header("Refresh: 3; url=login.php");
			} else {
				show_existing_task($_SESSION['valid_user_id']);
				?>
				<a href = "task.php?mode=create">Creating new task</a>
				<?php
			}

			break;
		case 'create':
			show_creating_form();
			break;
		case 'insert':
			if (add_task($_SESSION['valid_user_id'], $_REQUEST['title'], $_REQUEST['description'], $_REQUEST['duration'])) {
				echo "Create successfully!";
				header("Refresh: 3; url=task.php");
			} else {
				echo "Failed";
				header("Refresh: 3; url=task.php");
			}
			break;
		case 'edit':
	}
	


	showFooter();
?>