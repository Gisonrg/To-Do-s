<!--userBar.inc-->
<?php
	// showBar($id)
	function showBar($id) {
		?>
		<table>
			<tr>
				<th>User information</th>
			</tr>

			<tr>
				<td>User name</td>
				<td></td>
			</tr>
			<tr>
				<td>Level</td>
				<td></td>
			</tr>
			<tr>
				<td>EXP</td>
				<td></td>
			</tr>
			<tr>
				<td><a href="task.php">Manage my tasks</a></td>
			</tr>
			<tr>
				<td><a href="logout.php">Log Out</a></td>
			</tr>
		</table>
	}