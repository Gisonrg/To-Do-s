<div class="sidebar">
	<ul id="user-info"><p>Welcome!</p>
		<br />
		<li><p id="side-name"><?php echo($row['name']) ?></p></li>
		<br />
		<li><p id="side-level">Level <?php echo($row['level']) ?></p></li>
		<li><p id="side-exp">Exp: <?php echo($row['exp'].'/'.$row['level']*20) ?></p></li>
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