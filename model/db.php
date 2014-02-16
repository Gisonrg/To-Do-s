<!--db.php-->
<?php

require("config/config.inc");

// parameter: $id userID and $pwd password
// return: 0: login successful 1:invalid pwd 2:user does not exist

function db_connect() {
	$dbconn = pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DB_NAME." user=".DB_USERNAME." password=".DB_PASSWORD);
	if(!$dbconn){
		echo("Can't connect to the database");	
		exit;
	}
}


function user_authenticate($id, $pwd) {
	db_connect();
	$query="SELECT * FROM users WHERE id='$id';";
	$result=pg_query($dbconn, $query);

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


?>