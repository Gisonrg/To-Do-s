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

function user_register() {
	$dbconn = db_connect();
	$result = pg_prepare($dbconn, "my_query", 'SELECT * FROM shops WHERE name = $1');

	// Execute the prepared query.  Note that it is not necessary to escape
	// the string "Joe's Widgets" in any way
	$result = pg_execute($dbconn, "my_query", array("Joe's Widgets"));

	// Execute the same prepared query, this time with a different parameter
	$result = pg_execute($dbconn, "my_query", array("Clothes Clothes Clothes"));





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
	db_connect();
	$result = pg_prepare($dbconn, "my_query", 'SELECT * FROM users WHERE id = $1');
	$result = pg_execute($dbconn, "my_query", array("$id"));

	if(!$result) {
		echo("Cannot retrieve");
		exit;
	} else {
		return pg_fetch_array($result);
	}
}


?>