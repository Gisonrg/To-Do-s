<?php

require_once("config/config.inc");



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







?>