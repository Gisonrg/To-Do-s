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
	$result = pg_prepare($dbconn, "my_query", 'SELECT * FROM users WHERE name = $1 and email = $2');
	// $result=pg_query($dbconn, "select * from users;");

	// check if the name or email has been registered
	$result = pg_execute($dbconn, "my_query", array($name, $email));

	if($result){
		if (pg_affected_rows($result) ==0) {
			$result = pg_prepare($dbconn, "register", 'insert into users values(nextval(\'users_id_seq\'), $1 , $2 ,1,0, $3 )');
			$result = pg_execute($dbconn, "register", array($name, $password,$email));
			if($result){
				$result = pg_prepare($dbconn, "get_id", 'SELECT * FROM users WHERE name = $1 and email = $2');
				$result = pg_execute($dbconn, "get_id", array($name, $email));
				$user = pg_fetch_array($result);

				return $user['id'];

			} else {
				echo("Could not execute query");
				return false;
			}
		} else {
			echo "Your username or email has already been registered!";
			return false;
		}
	} else {
		echo("Could not execute query");
		return false;
	}

}


function user_authenticate($name, $pwd) {
	$dbconn = db_connect();
;
	$result = pg_prepare($dbconn, "my_query", 'SELECT * FROM users WHERE name = $1');
	$result = pg_execute($dbconn, "my_query", array("$name"));


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
	$result = pg_prepare($dbconn, "my_query", 'SELECT * FROM users WHERE id = $1');
	$result = pg_execute($dbconn, "my_query", array($id));

	if(!$result) {
		echo("Cannot retrieve");
		exit;
	} else {
		return pg_fetch_array($result);
	}
}

function retrieve_tasks_info($user_id) {
	$dbconn = db_connect();
	$result = pg_prepare($dbconn, "my_query", 'SELECT * FROM tasks WHERE userID = $1');
	$result = pg_execute($dbconn, "my_query", array($user_id));


	while ($row = pg_fetch_array($result)) {
		$tasks[] = $row;
	}
	if (!isset($task)) {
		return false;
	} else {
		return $tasks;
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
		return $row['userID'] == $userid;
	}
}

function add_task($userid, $title, $description, $slot) {
	$dbconn = db_connect();
			
	$result = pg_prepare($dbconn, "create", 'insert into tasks values(nextval(\'users_id_seq\'), $1 , $2 , $3, $4, $4)');
	$result = pg_execute($dbconn, "create", array($userid, $title, $description, $slot));
			
	if ($result) {
		return true;
	} else {
		return false;
	}

}


?>