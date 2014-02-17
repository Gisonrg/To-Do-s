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

      <div class="topheader">
        <?php show_nav($title);?>
      </div>

        <div class="container container-pad">



  <?php
  

	}



	function show_nav($title) {
		echo "<nav>";
      	if ($title == 'Home Page') {
      		echo '<ul><li><a class="active" href="index.php">Home</a></li>';
      	} else {
			echo '<ul><li><a href="index.php">Home</a></li>';
      	}
        if (isset($_SESSION['valid_user_id'])){
            if ($title == 'Manage My Account') {
            echo '<li><a class="active" href="account.php">Account</a></li>';
          } else {
        echo '<li><a href="account.php">Account</a></li>';
          }
          if ($title == 'Tasks') {
            echo '<li><a class="active" href="task.php">Task</a></li>';
          } else {
        echo '<li><a href="task.php">Task</a>';
          }
          if ($title == 'Logout') {
              echo '<ul><li><a class="active" href="logout.php">Logout</a></li>';
            } else {
        echo '<li><a href="logout.php">Logout</a></li>';
            }
        } else {
          if ($title == 'Login') {
              echo '<ul><li><a class="active" href="login.php">Login</a></li>';
            } else {
        echo '<li><a href="login.php">Login</a></li>';
            }

            if ($title == 'Register') {
              echo '<ul><li><a class="active" href="register.php">Sign Up</a></li>';
            } else {
        echo '<li><a href="register.php">Sign Up</a></li>';
            }
        }
		    if ($title == 'Contact') {
      		echo '<li><a class="active" href="contact.php">Contact</a></li></ul>';
      	} else {
			echo '<li><a href="contact.php">Contact</a></ul>';
      	}	       
      	

        
        echo "</nav>";
	}
?>


