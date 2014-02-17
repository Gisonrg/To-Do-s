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
	  <form method="post" action="account.php">
	    <h2>Update Your Information</h2>
	    
	    <label for="name"><strong>User Name</strong></label>
	    <?php echo $user['name']?>
	   	<input type="hidden" id="name" name="name" value="<?php echo $user['name']?>">
	    <br/>  
	    <label for="email"><strong>E-mail</strong></label>
	    <input type="email" id="email" name="email" placeholder="E-mail" required="" value="<?php echo $user['email']?>">
	    <br/>
		<br/>
		<section id="change_password">
		<p><strong>Please enter your old password if you want to change your current password</strong></p>
	    <label for="o_password"><strong> Old-Password</strong> </label>
	    <input type="password" id="o_password" name="o_password" placeholder="Old Password" >
	    <br/>
	    <label for="n_password"><strong> New-Password   </strong></label>
	    <input type="password" id="n_password" name="n_password" placeholder="New Password">
	    </section>
	    <br/>
		
	    <input type="submit" name="submit" value="Update">
	  </form>
	</div>

	<?



}










?>