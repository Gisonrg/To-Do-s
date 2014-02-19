<?php
function generate_time() {
	ini_set('date.timezone','Asia/Singapore');
	$localtime = localtime(time(), true);
	$msg = "<a class=\"news-time\">".($localtime['tm_year'] + 1900)."-".($localtime['tm_mon'] + 1)."-".($localtime['tm_mday'] + 1)." ".($localtime['tm_hour']).":".$localtime['tm_min'].":".$localtime['tm_sec']."</a>";
	return $msg;
}

function event_new_user($userid) {
	$row = retrieve_user_info($userid);
	$t = "At ".generate_time();
	$msg = "<span class=\"news-username\">".$row['name']."</span> joined us!";
	$type = "new_user";
	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "new_user", 'INSERT INTO events VALUES(nextval(\'events_id_seq\'), $1, $2, $3)');
	$result = pg_execute($dbconn, "new_user", array($t, $msg, $type));
	if ($result) {
		return true;
	} else {
		return false;
	}
}

function event_level_up($userid) {
	$row = retrieve_user_info($userid);
	$t = "At ".generate_time();
	$msg = "<span class=\"news-username\">".$row['name']."</span> reached level <span class=\"news-level\">".$row['level'] ."</span>!";
	$type = "level_up";
	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "level_up", 'INSERT INTO events VALUES(nextval(\'events_id_seq\'), $1, $2, $3)');
	$result = pg_execute($dbconn, "level_up", array($t, $msg, $type));

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
	//$msg = " <span class=\"news-username\">".$row['name']."</span> started task: <span class=\"news-task\">".$task['title']."</span>!";
	$msg = "<span class=\"news-username\">".$row['name']."</span> started a new task"."</span>!";
	$type = "new_task";
	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "new_task", 'INSERT INTO events VALUES(nextval(\'events_id_seq\'), $1, $2, $3)');
	$result = pg_execute($dbconn, "new_task", array($t, $msg, $type));

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
	//$msg = " <span class=\"news-username\">".$row['name']."</span> completed task: <span class=\"news-task\">".$task['title']."</span>!";
	$msg = "<span class=\"news-username\">".$row['name']."</span> completed a task"."</span>!";
	$type = "task_completed";
	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "task_completed", 'INSERT INTO events VALUES(nextval(\'events_id_seq\'), $1, $2, $3)');
	$result = pg_execute($dbconn, "task_completed", array($t, $msg, $type));

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