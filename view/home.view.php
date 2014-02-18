<!DOCTYPE html>
	<html lang="en">
	<?php include('common/header.inc');?>
	<body>
		<?php include('common/top.inc');?>
		
		<div class="container container-pad">	
			<div class="sidebar">
						<ul id="user-info"><p>Welcome!</p>
							<br />
							<li><p id="side_name"><?php echo($row['name']) ?></p></li>
							<br />
							<li><p id="side_level">Level <?php echo($row['level']) ?></p></li>
							<li><p id="side_exp">Exp: <?php echo($row['exp'].'/'.$row['level']*20) ?></p></li>
						</ul>
						<ul id="user-service"><p>Service</p>
							<li><a href="index.php">Homepage</a></li>
							<li><a href="task.php?mode=create">New Task</a></li>
							<li><a href="leaderboard.php">Leaderboard</a></li>
							<li><a href="account.php">Manage My Account</a></li>
							<li><a href="task.php">Manage My Tasks</a></li>
							<li><a href="logout.php">Log out</a></li>
						</ul>		
			</div>
		<div class="content">
			<?php if (!$tasks) {
				echo "You don't have any task to do!";
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
				}
				?>
			</table>



		</div>			

		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>