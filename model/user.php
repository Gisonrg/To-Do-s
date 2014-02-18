<?php

require_once("config/config.inc");


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

function update_user($name, $email, $id, $password=false) {
	$dbconn = db_connect();
	if (!$password) {
		$result = pg_prepare($dbconn, "", 'update users set email=$1 where name=$2 and id=$3');
		$result = pg_execute($dbconn, "", array($email, $name, $id));
	} else {
		$result = pg_prepare($dbconn, "", 'update users set email=$1, password=$2 where name=$3 and id=$4');
		$result = pg_execute($dbconn, "", array($email,  $password, $name, $id));
	}
	if($result){
		return true;
	} else {
		return false;
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

function retrieve_leader_info() {
	function leaders_sort($a, $b) {
		if ($a['exp'] == $b['exp']) {
			return 0;
		} else {
			return $a['exp'] > $b['exp']? -1 : 1;
		}
	}

	$dbconn = db_connect();		
	$result = pg_prepare($dbconn, "getleaders", 'SELECT name, level, exp FROM users');
	$result = pg_execute($dbconn, "getleaders", array());

	while ($row = pg_fetch_array($result)) {
		$leaders[] = $row;
	}
	if (isset($leaders)) {
		usort($leaders, "leaders_sort");
		if (count($leaders) > 10) {
			$leaders = array_slice($leaders, 0, 9);
		}
		return $leaders;
	} else {
		return false;
	}
}

function add_exp($userid, $exp) {
	$row = retrieve_user_info($userid);
	$new_exp = $row['exp'] + $exp;
	$new_level = ceil($new_exp / 20);
	$flag = 0;
	if ($new_level > $row['level']) {
		$flag = 1;
	}

	$dbconn = db_connect();
	$result = pg_prepare($dbconn, "add_exp", 'UPDATE users SET exp=$2, level=$3 WHERE id=$1');
	$result = pg_execute($dbconn, "add_exp", array($userid, round($new_exp), $new_level));//magic number here, need improvement
 
	if ($flag == 1) {
		if ((event_level_up($userid)) && ($result)) {
			return true;
		} else {
			return false;
		}
	} else if ($result) {
		return true;
	} else {
		return false;
	}
}



?>