<!--db.php-->
<?php

require_once("config/config.inc");


function db_connect() {
	$dbconn = pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DB_NAME." user=".DB_USERNAME." password=".DB_PASSWORD);
	if(!$dbconn){
		echo("Can't connect to the database");	
		exit;
	}
	return $dbconn;
}

function user_register($name, $password, $email) {
	$dbconn = db_connect();
	$result = pg_prepare($dbconn, "my_query", 'SELECT * FROM users WHERE name = $1 or email = $2');
	// check if the name or email has been registered
	$result = pg_execute($dbconn, "my_query", array($name, $email));

	if($result) {
		if (pg_num_rows($result) ==0) {
			$result = pg_prepare($dbconn, "register", 'insert into users values(nextval(\'users_id_seq\'), $1 , $2 ,1,0, $3 )');
			$result = pg_execute($dbconn, "register", array($name, $password,$email));
			
			if($result){
				$result = pg_prepare($dbconn, "get_id", 'SELECT * FROM users WHERE name = $1 and email = $2');
				$result = pg_execute($dbconn, "get_id", array($name, $email));
				$user = pg_fetch_array($result);
				return $user['id'];

			} else {
				return -1;
			}
		} else {
			return -2;
		}
	} else {
		return -1;
	}

}


function user_authenticate($name, $pwd) {
	$dbconn = db_connect();
	$result = pg_prepare($dbconn, "update", 'SELECT * FROM users WHERE name = $1');
	$result = pg_execute($dbconn, "update", array("$name"));


	$flag = 0;
	while ($row = pg_fetch_array($result)) {
		$flag = 1;
		if ($row['password'] == $pwd) {
			return $row['id']; //success
		}
	}

	if ($flag == 1) {
		return -1; //invalid password
	} else {
		return -2; //does not exit
	}
}


function retrieve_user_info($id) {
	$dbconn = db_connect();

	$result = pg_prepare($dbconn, "", 'SELECT * FROM users WHERE id = $1');
	$result = pg_execute($dbconn, "", array($id));


	if(!$result) {
		echo("Cannot retrieve");
		exit;
	} else {
		return pg_fetch_array($result);
	}
}

function retrieve_tasks_info($user_id) {
	$dbconn = db_connect();
	$result = pg_prepare($dbconn, "gettask", 'SELECT * FROM tasks WHERE userid = $1');
	$result = pg_execute($dbconn, "gettask", array($user_id));


	while ($row = pg_fetch_array($result)) {
		$tasks[] = $row;
	}
	if (!isset($tasks)) {
		return false;
	} else {
		return $tasks;
	}
}

function retrieve_ongoing_tasks_info($user_id) {
	$dbconn = db_connect();
	$result = pg_prepare($dbconn, "gettask", 'SELECT * FROM tasks WHERE userid = $1 and remainingslot > 0');
	$result = pg_execute($dbconn, "gettask", array($user_id));


	while ($row = pg_fetch_array($result)) {
		$tasks[] = $row;
	}
	if (!isset($tasks)) {
		return false;
	} else {
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
			
	$result = pg_prepare($dbconn, "create", 'INSERT INTO tasks VALUES(nextval(\'users_id_seq\'), $1 , $2 , $3, $4, $4)');
	$result = pg_execute($dbconn, "create", array($userid, $title, $description, $slot));
			
	if ($result) {
		return true;
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
		return true;
	} else {
		return false;
	}
}

function add_exp($userid, $exp) {
	$row = retrieve_user_info($userid);
	$new_exp = $row['exp'] + $exp;

	$dbconn = db_connect();
	$result = pg_prepare($dbconn, "add_exp", 'UPDATE users SET exp=$2, level=$3 WHERE id=$1');
	$result = pg_execute($dbconn, "add_exp", array($userid, round($new_exp), ceil($new_exp / 20)));//magic number here, need improvement

	if ($result) {
		return true;
	} else {
		return false;
	}
}


?>