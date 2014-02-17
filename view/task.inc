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
						echo "<td><a href=task.php?task_id=".$tasks[$i]['id'].">".$tasks[$i]['title']."</a></td>";
						echo "<td>".$tasks[$i]['description']."</td>";
						echo "<td>".((1 - $tasks[$i]['remainingslot']/$tasks[$i]['totalslot']) * 100)."%"."</td>";
						echo "<td>"."25"."</td>";
						echo "</tr>";
					}
				?>
			</table>
			<?php
		}
	}

	// show_creating_form()
	function show_creating_form() {
		?>
		<form  method="post" action="" role="form">
			<h2>Creating new task</h2>
			<label for="name">Title</label>
			<input type="text" name="title" placeholder="Your task title" required="required" autofocus="">
			<br/>
			<label for="name">Description</label>
			<textarea name="description" rows="5" placeholder="Your description for the task" required=""></textarea>
			<br/>
			<label for="name">Slot (30 min as a unit)</label>
			<input type="number" name="duration" min="1" max="20" />
			<br />
			<input type="submit" name="submit" value="create">
		</form>
		<?php
	}

	// show_updating_form($taskid)
	function show_updating_form($taskid) {
		$row = retrieve_task_info($taskid);
		?>
		<form  method="post" action="" role="form">
			<h2>Updating task</h2>
			<label for="name">Title</label>
			<input type="text" name="title" placeholder="Your task title"  value="<?php echo $row['title'];?>" >
			<br/>
			<label for="name">Description</label>
			<textarea name="description" rows="5" placeholder="Your description for the task" required=""><?php echo $row['description'];?></textarea>
			<br/>
			<label for="name">Slot (30 min as a unit)</label>
			<input type="number" name="duration" min="1" max="20" value="<?php echo $row['totalslot'];?>"/>
			<br />
			<input type="submit" name="submit" value="update">
		</form>
		<?php
	}
?>