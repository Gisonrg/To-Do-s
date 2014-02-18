<!DOCTYPE html>
	<html lang="en">
	<?php include('common/header.inc');?>
	<body>
		<?php include('common/top.inc');?>
		
		<div class="container container-pad">
			<div class="full-page">

			<?php if (!isset($_SESSION['valid_user_id'])) {
				if(isset($register_result) && $register_result<0) { ?>
				<div class="msg-error">
					<img src="static/img/error.gif" alt="Error">
					<?echo $msg;?>
				</div>
			<?php } ?>
					<div class="register_form">
					  <h2>New User Register</h2>   
					  <form method="post" action="" role="form">
					    <fieldset>
					    <label for="name">User Name</label>
					    <input type="text" id="name" name="name" placeholder="User Name" required="" autofocus="" value="<?php echo $username;?>">
					    <br/>  
					    <label for="email">E-mail</label>
					    <input type="email" id="email" name="email" placeholder="E-mail" required="" value="<?php echo $email;?>">
					    <br/>
					    <label for="password">Password</label>
					    <input type="password" id="password" name="password" placeholder="Password" required="">
					    <br/>
					    </fieldset>
					    <input type="submit" name="submit" value="Sign Up">
					  </form>
					</div>
			<?php  } else { 
				
		        if(isset($register_result) && $register_result>=0) { ?>
				<div class="msg-success">
					<img src="static/img/right.gif" alt="Success">
					<?echo $msg;?>
				</div>
		        <?php  
		        header("Refresh: 3; url=index.new.php");
		    		}
		    	}
				?>
				</div>	
		    </div>
		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>