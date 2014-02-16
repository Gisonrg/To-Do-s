<!--db.php-->
<?php

require_once("config/config.inc");

// parameter: $id userID and $pwd password
// return: 0: login successful 1:invalid pwd 2:user does not exist
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


function user_authenticate($id, $pwd) {
	$dbconn = db_connect();
	$query="SELECT * FROM users WHERE id='$id';";
	$result=pg_query($dbconn, $query);
	$result = pg_prepare($dbconn, "my_query", 'SELECT * FROM users WHERE id = $1');
	$result = pg_execute($dbconn, "my_query", array("$id"));


	$flag = 0;
	while ($row = pg_fetch_array($result)) {
		$flag = 1;
		if ($row[password] == $pwd) {
			return 0; //success
		}
	}

	if ($flag == 1) {
		return 1; //invalid password
	} else {
		return 2; //does not exit
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


?>