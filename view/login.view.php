<!DOCTYPE html>
	<html lang="en">
	<?php include('common/header.inc');?>
	<body>
		<?php include('common/top.inc');?>
		
		<div class="container container-pad">
			<div class="full-page">
			<?php if(isset($login_result) && $login_result<0) { ?>
				<div class="msg-error">
					<img src="static/img/error.gif" alt="Error">
					<?echo $msg;?>
				</div>
			<?php } ?>
		    
		        <div class="login_form">
		            <h2>Please Sign In</h2>
		            <form method="post" role="form">
		                <fieldset>
		                    <label for="name">Username</label>
		                    <input type="text" name="name" placeholder="User Name" required="" autofocus="" value="<?php echo $username;?>">
		                    <br />
		                    <label for="name">Password</label>
		                    <input type="password" name="password" placeholder="Password" required="">
		                    <br />
		                    <p>
		                        <a href="find_password.php">Forget the password?</a>
		                    </p>
		                    <br />
		                </fieldset>
		                <input type="submit" name="submit" value="Login">
		            </form>
		        </div>
				</div>	
		    </div>
		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>