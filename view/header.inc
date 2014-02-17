<!--header.inc-->
<?php 
	require("userBar.inc");
	// showHeader($title)
	function showHeader($title) {
	?>
		<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="utf-8">
				<title><?php echo "$title" ?></title>
				<link rel="stylesheet" type="text/css" href="static/css/style.css">
			</head>
			<body>
        <?php show_nav($title);?>
        <div class="container container-pad">
          <h1>Test！</h1>



  <?php
  

	}



	function show_nav($title) {
		echo "<nav>";
      	if ($title == 'Home Page') {
      		echo '<a class="active" href="index.php">Home</a>';
      	} else {
			echo '<a href="index.php">Home</a>';
      	}
        if (isset($_SESSION['valid_user_id'])){
            if ($title == 'Manage My Account') {
            echo '<a class="active" href="account.php">Account</a>';
          } else {
        echo '<a href="account.php">Account</a>';
          }
          if ($title == 'Tasks') {
            echo '<a class="active" href="task.php">Task</a>';
          } else {
        echo '<a href="task.php">Task</a>';
          }
          if ($title == 'Logout') {
              echo '<a class="active" href="logout.php">Logout</a>';
            } else {
        echo '<a href="logout.php">Logout</a>';
            }
        } else {
          if ($title == 'Login') {
              echo '<a class="active" href="login.php">Login</a>';
            } else {
        echo '<a href="login.php">Login</a>';
            }

            if ($title == 'Register') {
              echo '<a class="active" href="register.php">Sign Up</a>';
            } else {
        echo '<a href="register.php">Sign Up</a>';
            }
        }
		    if ($title == 'Contact') {
      		echo '<a class="active" href="contact.php">Contact</a>';
      	} else {
			echo '<a href="contact.php">Contact</a>';
      	}	       
      	

        
        echo "</nav>";
	}
?>


