<?php
function display_success($msg) {
	echo "<div class=\"msg-success\">";
	echo "<img src=\"static/img/right.gif\" alt=\"Success\">";
	echo "<h3>Success!</h3>";
	echo "<p>$msg</p>";
	echo "</div>";
}

function display_error($msg) {
	echo "<div class=\"msg-error\">";
	echo "<img src=\"static/img/error.gif\" alt=\"Error\">";
	echo "<h3>Error!</h3>";
	echo "<p>$msg</p>";
	echo "</div>";
}









?>

