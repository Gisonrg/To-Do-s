<!--userBar.inc-->
<?php
	// showBar($id)
	function showBar($id) {
		require_once("model/db.php");
		$row = retrieve_user_info($_SESSION['valid_user_id']);
		?>
		<div class="sidebar">
			<ul id="user-info"><p>Welcome!</p>
				<li><p id="side_name"><?php echo($row['name']) ?></p></li>
				<li><p id="side_level">Level <?php echo($row['level']) ?></p></li>
				<li><p id="side_exp">Exp: <?php echo($row['exp'].'/'.$row['level']*20) ?></p></li>
			</ul>
			<ul id="user-service"><p>Service</p>
				<li><a href="account.php">Manage My Account</a></li>
				<li><a href="task.php">Manage My Tasks</a></li>
				<li><a href="logout.php">Log out</a></li>
			</ul>
		</div>
		<?php
	}
?>