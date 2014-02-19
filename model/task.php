<?php

function tasks_sort($a, $b) {
	if ($a['id'] == $b['id']) {
		return 0;
	} else {
		return $a['id'] > $b['id']? 1 : -1;
	}
}

function retrieve_tasks_info($user_id) {
	$dbconn = db_connect();
	$result = pg_prepare($dbconn, "", 'SELECT * FROM tasks WHERE userid = $1');
	$result = pg_execute($dbconn, "", array($user_id));


	while ($row = pg_fetch_array($result)) {
		$tasks[] = $row;
	}
	if (!isset($tasks)) {
		return false;
	} else {
		usort($tasks, "tasks_sort");
		return $tasks;
	}
}

function retrieve_ongoing_tasks_info($user_id) {
	$dbconn = db_connect();
	$result = pg_prepare($dbconn, "", 'SELECT * FROM tasks WHERE userid = $1 and remainingslot > 0');
	$result = pg_execute($dbconn, "", array($user_id));


	while ($row = pg_fetch_array($result)) {
		$tasks[] = $row;
	}
	if (!isset($tasks)) {
		return false;
	} else {
		usort($tasks, "tasks_sort");
		return $tasks;
	}
}

function retrieve_task_info($task_id) {
	$dbconn = db_connect();

	$result = pg_prepare($dbconn, "", 'SELECT * FROM tasks WHERE id = $1');
	$result = pg_execute($dbconn, "", array($task_id));


	if(!$result) {
		echo("Cannot retrieve");
		exit;
	} else {
		return pg_fetch_array($result);
	}
}

// varify_user_and_task($userid, $taskid)
function varify_user_and_task($userid, $taskid) {
	$dbconn = db_connect();
	$result = pg_prepare($dbconn, "my_query", 'SELECT userID FROM tasks WHERE id = $1');
	$result = pg_execute($dbconn, "my_query", array($taskid));

	if(!$result) {
		echo("No such a task");
		exit;
	} else {
		$row = pg_fetch_array($result);
		return $row['userid'] == $userid;
	}
}

function add_task($userid, $title, $description, $slot) {
	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "create", 'INSERT INTO tasks VALUES(nextval(\'tasks_id_seq\'), $1 , $2 , $3, $4, $4)');
	$result = pg_execute($dbconn, "create", array($userid, $title, $description, $slot));
			
	if ($result) {
		$result2 = pg_prepare($dbconn, "read", 'SELECT id FROM tasks WHERE title=$1 and userid=$2');
		$result2 = pg_execute($dbconn, "read", array($title, $userid));
		if ($row = pg_fetch_array($result2)) {
			event_new_task($row['id']);
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}

}

function update_task($id, $title, $description, $totalslot, $remainingslot) {
	$dbconn = db_connect();
	$result = pg_prepare($dbconn, "update", 'UPDATE tasks SET title=$1, description=$2, totalslot=$3, remainingslot=$4 WHERE id=$5');
	$result = pg_execute($dbconn, "update", array($title, $description, $totalslot, $remainingslot, $id));
			
	if ($result) {
		return true;
	} else {
		return false;
	}
}

function do_task($id, $remainingslot) {
	$dbconn = db_connect();
	$result = pg_prepare($dbconn, "do", 'UPDATE tasks SET remainingslot=$2 WHERE id=$1');
	$result = pg_execute($dbconn, "do", array($id, $remainingslot));

	$result2 = pg_prepare($dbconn, "addexp", 'SELECT * FROM tasks WHERE id=$1');
	$result2 = pg_execute($dbconn, "addexp", array($id));
	$row = pg_fetch_array($result2);

	if ($result && add_exp($row['userid'], 25 / $row['totalslot'])) {//magic number
		if (($row['remainingslot'] == 0) && (event_task_completed($id))) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}
?>