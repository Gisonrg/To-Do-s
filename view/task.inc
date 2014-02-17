<!--task.inc-->

<?php

	require_once("model/db.php");
	// show_existing_task($id)
	function show_existing_task($userid) {
		if (!isset($userid)) {
			echo "you didn't login";
			header("Refresh: 3; url=login.php");
		} else {
			$tasks = retrieve_tasks_info($userid);
		}
		if (!$tasks) {
			echo "You don't have any task to do!";
		} else {
			?>
			<table>
				<tr>
					<th>Title</th>
					<th>Description</th>
					<th>Progress</th>
					<th>EXP</th>
				</tr>
				<?php
					for ($i = 0; $i < count($tasks); $i++) {
						echo "<tr>";
						echo "<td>".$tasks[$i]['title']."</td>";
						echo "<td>".$tasks[$i]['description']."</td>";
						echo "<td>".($tasks[$i]['remainingSlot']/$tasks[$i]['totalSlot']*100)."%"."</td>";
						echo "<td>"."25"."</td>";
						echo "</tr>";
					}
				?>
			</table>
			<?php
		}
	}
?>