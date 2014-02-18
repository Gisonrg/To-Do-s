<!--leaderboard.inc-->
<table>
	<?php 
		$leaders = retrieve_leader_info();
		if (count($leaders) == 0) {
			echo "No one here leh";
		} else {
			for ($i = 0; $i < count($leaders); $i++) {
				echo "<tr><td>".$leaders[$i]['name']."</td></tr>";
				echo "<tr><td>Level: ".$leaders[$i]['level']."</td><td>"."total hours: 100"."</td></tr>";
			}
		}
	?>
</table>