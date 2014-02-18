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
			<table class="view-task">
				<tr>
					<th>Title</th>
					<th>Description</th>
					<th>Progress</th>
					<th>EXP</th>
					<th>Option</th>
					<th>Status</th>
				</tr>
				<?php
					for ($i = 0; $i < count($tasks); $i++) {
						echo "<tr>";
						echo "<td><a href=task.php?task_id=".$tasks[$i]['id'].">".$tasks[$i]['title']."</a></td>";
						echo "<td>".$tasks[$i]['description']."</td>";
						echo "<td><progress max=\"100\" value=\"".((1 - $tasks[$i]['remainingslot']/$tasks[$i]['totalslot']) * 100)."\"</td>";
						echo "<td>"."25"."</td>";
						if ($tasks[$i]['remainingslot'] > 0) {
							echo "<td><form action=\"\" method=\"post\">";
							echo "<input type=\"hidden\" name=\"taskid\" value=\"".$tasks[$i]['id']."\">";
							echo "<input type=\"submit\" name=\"submit\" value=\"do\">";
							echo "</form></td>";
							echo "<td>Ongoing</td>";
						} else {
							echo "<td></td>";
							echo "<td>Completed</td>";
						}
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
		<div class="task-create">

			<form  method="post" action="" role="form">
				<h2>Creating new task</h2>
				<label for="name">Title</label>
				<input type="text" name="title" placeholder="Your task title" required="required" autofocus="">
				<br/>
				<label for="name">Description</label>
				<textarea name="description" rows="5" placeholder="Your description for the task" required=""></textarea>
				<br/>
				<label for="name">Slot (30 min as a unit)</label>
				<input type="number" name="duration" min="1" max="20" required="required" />
				<br />
				<input type="submit" name="submit" value="Create">
			</form>
		</div>
		<?php
	}

	// show_ongoing_existing_task($id)
	function show_ongoing_existing_task($userid) {
		if (!isset($userid)) {
			echo "you didn't login";
			header("Refresh: 3; url=login.php");
		} else {
			$tasks = retrieve_ongoing_tasks_info($userid);
		}
		echo "<span class='tag'>&nbsp;Ongoing&nbsp;</span>";
		if (!$tasks) {
			echo "<div class=\"view-warning\">You don't have any task to do!</div>";
		} else {
			?>
			<table class="view-task">
				<?php
					for ($i = 0; $i < count($tasks); $i++) {
						echo "<tr>";
						echo "<td><a href=task.php?task_id=".$tasks[$i]['id'].">".$tasks[$i]['title']."</a></td>";
						echo "<td><progress max=\"100\" value=\"".((1 - $tasks[$i]['remainingslot']/$tasks[$i]['totalslot']) * 100)."\"</td>";
						echo "<td><form action=\"\" method=\"post\">";
						echo "<input type=\"hidden\" name=\"taskid\" value=\"".$tasks[$i]['id']."\">";
						echo "<input type=\"submit\" name=\"submit\" value=\"do\">";
						echo "</form></td>";
						echo "</tr>";
					}
				?>
			</table>
			<br />
			<?php
		}
	}

	// show_news()
	function show_news() {
		?>
		<br />
			<span class='tag'>&nbsp;Wat's new&nbsp;</span>
			<table class="view-news">
				<?php
				$events = retrieve_current_events();
				if (count($events) == 0) {
					echo "no news!";
				} else {
					for ($i = 0; $i < count($events); $i++) {
						echo "<tr><td>".$events[$i]['content']."</td></tr>";
					}
				}

				?>
			</table>
		<?php
	}

	// show_updating_form($taskid)
	function show_updating_form($taskid) {
		$row = retrieve_task_info($taskid);
		?>
		<div class="task-update">
			<form  method="post" action="" role="form" class="task-form">
				<h2>Updating task</h2>
				<label for="name">Title</label>
				<input type="text" name="title" placeholder="Your task title"  value="<?php echo $row['title'];?>" >
				<br />
				<label id="description">Description</label>
				<textarea name="description" rows="5" placeholder="Your description for the task" required=""><?php echo $row['description'];?></textarea>
				<br/>
				<label for="name">Slot (30 min as a unit)</label>
				<input type="number" name="duration" min="1" max="20" value="<?php echo $row['totalslot'];?>"/>
				<br />
				<input type="submit" name="submit" value="Update">
			</form>
		</div>
		<?php
	}
?>