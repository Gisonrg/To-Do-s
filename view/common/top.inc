<div class="topheader">
	    <nav>
	        <ul>
	        	<?php 
	        	if (isset($_SESSION['valid_user_id'])) {
				   $nav_item = array(array('name'=>'Home','link'=>'index.new.php'),
					        		array('name'=>'Account','link'=>'account.new.php'),
					        		array('name'=>'Task','link'=>'task.php'),
					        		array('name'=>'Logout','link'=>'logout.php'),
					        		array('name'=>'About','link'=>'contact.php'));
				} else {
					$nav_item = array(array('name'=>'Home','link'=>'index.new.php'),
					        		array('name'=>'Login','link'=>'login.new.php'),
					        		array('name'=>'Sign Up','link'=>'register.new.php'),
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
</div>