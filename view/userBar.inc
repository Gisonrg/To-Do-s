<!--userBar.inc-->
<?php
	// showBar($id)
	function showBar($id) {
		require_once("../model/db.php");
		$row = retrieve_user_info($_SESSION['userID']);
		?>
		<table>
			<tr>
				<th>User information</th>
			</tr>

			<tr>
				<td>User name</td>
				<td><?php echo($row['username']) ?></td>
			</tr>
			<tr>
				<td>Level</td>
				<td><?php echo($row['level']) ?></td>
			</tr>
			<tr>
				<td>EXP</td>
				<td><?php echo($row['exp']) ?></td>
			</tr>
			<tr>
				<td><a href="task.php">Manage my tasks</a></td>
			</tr>
			<tr>
				<td><a href="logout.php">Log Out</a></td>
			</tr>
		</table>
		<?php
	}
?>