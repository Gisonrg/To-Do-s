<div class="topheader">
	    <nav>
	        <ul>
	        	<?php 
	        	if (isset($_SESSION['valid_user_id'])) {
				   $nav_item = array(array('name'=>'Home','link'=>'index.php'),
					        		array('name'=>'Account','link'=>'account.php'),
					        		array('name'=>'Task','link'=>'task.php'),
					        		array('name'=>'Logout','link'=>'logout.php'),
					        		array('name'=>'About','link'=>'contact.php'));
				} else {
					$nav_item = array(array('name'=>'Home','link'=>'index.php'),
					        		array('name'=>'Login','link'=>'login.php'),
					        		array('name'=>'Sign Up','link'=>'register.php'),
					        		array('name'=>'About','link'=>'contact.php'));
				}
	        	foreach ($nav_item as $item ) { 
	        		echo "<li>";
	        		
	        		echo "<a ";
	        		if ($item['name'] == $_SESSION['active']) {
	        			echo "class=\"active\" ";
	        		}
	        		echo "href=\"".$item['link']."\">".$item['name']."</a></li>";
				}		
	            ?>
	        </ul>
	   </nav>
	   <div class="topheader logo">
	   <p><img class="logo-pic" src="static/img/logo.png" alt=""></img>Do-It</p>
	   <small>&nbsp;&nbsp;A simple, effecient and free to-do list.</small>
	   </div>
</div>