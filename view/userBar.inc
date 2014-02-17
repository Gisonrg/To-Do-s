<!--userBar.inc-->
<?php
	function showLoginBar() {
	?>
		<div class="sidebar">
			<ul id="user-info"><p>Welcome!</p>
				<div class="login_form">
					<form  method="post" action="login.php" role="form">
					<fieldset>
						<label for="name">Username</label>
						<br/>
						<input type="text" name="name" placeholder="User Name" required="" autofocus="">
						<br/>
						<label for="name">Password</label>
						<br/>
						<input type="password" name="password" placeholder="Password" required="">
						<br/>
						<p id="found-psw"><a href="find_password.php">Forget the password?</a></p>
					</fieldset>
						<input type="submit" name="submit"value="login">
					</form>
				</div>
			</ul>
		</div>
		<?php
	}


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
				<li><a href="index.php">Homepage</a></li>
				<li><a href="task.php?mode=create">New Task</a></li>
				<li><a href="account.php">Manage My Account</a></li>
				<li><a href="task.php">Manage My Tasks</a></li>
				<li><a href="logout.php">Log out</a></li>
			</ul>
		</div>
		<?php
	}
?>