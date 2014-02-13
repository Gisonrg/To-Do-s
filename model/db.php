<!--db.php-->
<?php
// parameter: $id userID and $pwd password
// return: 0: login successful 1:invalid pwd 2:user does not exist
function user_authenticate($id, $pwd) {

	$dbconn = pg_connect("host=127.0.0.1 port=5432 dbname=todo user=admin password=admin");
	if(!$dbconn){
		echo("Can't connect to the database");	
		exit;
	}

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