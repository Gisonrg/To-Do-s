<?php
function generate_time() {
	$localtime = localtime(time(), true);
	$msg = ($localtime['tm_year'] + 1900)."-".($localtime['tm_mon'] + 1)."-".($localtime['tm_mday'] + 1)." ".($localtime['tm_hour']-17).":".$localtime['tm_min'].":".$localtime['tm_sec'];
	return $msg;
}

function event_new_user($userid) {
	$row = retrieve_user_info($userid);
	$msg = "At ".generate_time()." ".$row['name']." joined us!";
	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "new_user", 'INSERT INTO events VALUES(nextval(\'events_id_seq\'), $1)');
	$result = pg_execute($dbconn, "new_user", array($msg));

	if ($result) {
		return true;
	} else {
		return false;
	}
}

function event_level_up($userid) {
	$row = retrieve_user_info($userid);
	$msg = "At ".generate_time()." ".$row['name']." reached level ".$row['level'] ."!";
	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "level_up", 'INSERT INTO events VALUES(nextval(\'events_id_seq\'), $1)');
	$result = pg_execute($dbconn, "level_up", array($msg));

	if ($result) {
		return true;
	} else {
		return false;
	}
}

function event_new_task($taskid) {
	$task = retrieve_task_info($taskid);
	$row = retrieve_user_info($task['userid']);
	$msg = "At ".generate_time()." ".$row['name']." started task: ".$task['title']."!";
	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "new_task", 'INSERT INTO events VALUES(nextval(\'events_id_seq\'), $1)');
	$result = pg_execute($dbconn, "new_task", array($msg));

	if ($result) {
		return true;
	} else {
		return false;
	}
}

function event_task_completed($taskid) {
	$task = retrieve_task_info($taskid);
	$row = retrieve_user_info($task['userid']);
	$msg = "At ".generate_time()." ".$row['name']." completed task: ".$task['title']."!";
	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "task_completed", 'INSERT INTO events VALUES(nextval(\'events_id_seq\'), $1)');
	$result = pg_execute($dbconn, "task_completed", array($msg));

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
		if (count($events) > 10) {
			usort($events, "events_sort");
			$events = array_slice($events, 0, 9);
		}
		return $events;
	} else {
		return false;
	}
}


?>