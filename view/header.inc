<!--header.inc-->
<?php 
	// showHeader($title)
	function showHeader($title) {
		require("userBar.inc");
		?>
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="utf-8">
				<title><?php echo "$title" ?></title>
			</head>
			<body>

			<ul>
              	<?php 
              	if ($title == 'Homepage') {
              		echo '<li class="active"><a href="index.php">Home</a></li>';
              	} else {
					echo '<li><a href="index.php">Home</a></li>';
              	}
				if ($title == 'Contact') {
              		echo '<li class="active"><a href="contact.php">Contact</a></li>';
              	} else {
					echo '<li><a href="contact.php">Contact</a></li>';
              	}	       
              	if ($title == 'Account') {
              		echo '<li class="active"><a href="account.php">Account</a></li>';
              	} else {
					echo '<li><a href="account.php">Account</a></li>';
              	}
              	if ($title == 'Task') {
              		echo '<li class="active"><a href="task.php">Task</a></li>';
              	} else {
					echo '<li><a href="task.php">Task</a></li>';
              	}

                if (isset($_SESSION['valid_user_id'])){
                	if ($title == 'Logout') {
	              		echo '<li class="active"><a href="logout.php">Logout</a></li>';
	              	} else {
						echo '<li><a href="logout.php">Logout</a></li>';
	              	}

	              	showBar($_SESSION['valid_user_id']);
                } else {
                	if ($title == 'Login') {
	              		echo '<li class="active"><a href="login.php">Login</a></li>';
	              	} else {
						echo '<li><a href="login.php">Login</a></li>';
	              	}

	              	if ($title == 'Signup') {
	              		echo '<li class="active"><a href="register.php">Sign Up</a></li>';
	              	} else {
						echo '<li><a href="register.php">Sign Up</a></li>';
	              	}
                }

                ?>
              </ul>
		<?php
	}

	

?>


