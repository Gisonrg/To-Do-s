<?php
require_once("config/config.inc");

function check_login() {
	if (isset($_SESSION['valid_user_id'])) {
		return false;
	} else {
		return true;
	}
}

function display_user_information($id) {

	$user = retrieve_user_info($id);
	?>
	<div id="view_account">
	 <h2>Update Your Information</h2>
	  <form method="post" action="account.php">
	   
	    
	    <label for="name"><strong>User Name</strong></label>
	   	<input type="text" id="name" name="name" value="<?php echo $user['name']?>" disabled>
	    <br/>  
	    <label for="email"><strong>E-mail</strong></label>
	    <input type="email" id="email" name="email" placeholder="E-mail" required="" value="<?php echo $user['email']?>">
	    <br/>
		<section id="change_password">
	    <label for="o_password"><strong> Old-Password</strong> </label>
	    <input type="password" id="o_password" name="o_password" placeholder="Old Password" >
	    <br/>
	    <label for="n_password"><strong> New-Password   </strong></label>
	    <input type="password" id="n_password" name="n_password" placeholder="New Password">
	   	<p>* <strong>Enter the password only if you want to change your password.</strong></p>
	    </section>
	    <br/>
		
	    <input type="submit" class="button" name="submit" value="Update">
	  </form>
	</div>

	<?



}










?>