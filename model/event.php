<?php
function generate_time() {
	$localtime = localtime(time(), true);
	$msg = "<a class=\"news-time\">".($localtime['tm_year'] + 1900)."-".($localtime['tm_mon'] + 1)."-".($localtime['tm_mday'] + 1)." ".($localtime['tm_hour']-17).":".$localtime['tm_min'].":".$localtime['tm_sec']."</a>";
	return $msg;
}

function event_new_user($userid) {
	$row = retrieve_user_info($userid);
	$t = "At ".generate_time();
	$msg = " <p class=\"news-username\">".$row['name']."</p> joined us!";
	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "new_user", 'INSERT INTO events VALUES(nextval(\'events_id_seq\'), $1, $2)');
	$result = pg_execute($dbconn, "new_user", array($t, $msg));

	if ($result) {
		return true;
	} else {
		return false;
	}
}

function event_level_up($userid) {
	$row = retrieve_user_info($userid);
	$t = "At ".generate_time();
	$msg = " <p class=\"news-username\">".$row['name']."</p> reached level <p class=\"news-level\">".$row['level'] ."</p>!";
	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "level_up", 'INSERT INTO events VALUES(nextval(\'events_id_seq\'), $1, $2)');
	$result = pg_execute($dbconn, "level_up", array($t, $msg));

	if ($result) {
		return true;
	} else {
		return false;
	}
}

function event_new_task($taskid) {
	$task = retrieve_task_info($taskid);
	$row = retrieve_user_info($task['userid']);
	$t = "At ".generate_time();
	$msg = " <p class=\"news-username\">".$row['name']."</p> started task: <p class=\"news-task\">".$task['title']."</p>!";
	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "new_task", 'INSERT INTO events VALUES(nextval(\'events_id_seq\'), $1, $2)');
	$result = pg_execute($dbconn, "new_task", array($t, $msg));

	if ($result) {
		return true;
	} else {
		return false;
	}
}

function event_task_completed($taskid) {
	$task = retrieve_task_info($taskid);
	$row = retrieve_user_info($task['userid']);
	$t = "At ".generate_time();
	$msg = " <p class=\"news-username\">".$row['name']." completed task: <p class=\"news-task\">".$task['title']."</p>!";
	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "task_completed", 'INSERT INTO events VALUES(nextval(\'events_id_seq\'), $1, $2)');
	$result = pg_execute($dbconn, "task_completed", array($t, $msg));

	if ($result) {
		return true;
	} else {

		return false;
	}
}

function retrieve_current_events() {
	
	function events_sort($a, $b) {
		if ($a['id'] == $b['id']) {
			return 0;
		} else {
			return $a['id'] > $b['id']? -1 : 1;
		}
	}

	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "getevents", 'SELECT * FROM events');
	$result = pg_execute($dbconn, "getevents", array());

	while ($row = pg_fetch_array($result)) {
		$events[] = $row;
	}
	if (isset($events)) {
		usort($events, "events_sort");
		if (count($events) > 10) {
			$events = array_slice($events, 0, 9);
		}
		return $events;
	} else {
		return false;
	}
}

?>