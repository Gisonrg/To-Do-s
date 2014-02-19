<!DOCTYPE html>
	<html lang="en">
	<?php include('common/header.inc');?>
	<body>
		<?php include('common/top.inc');?>
		<div class="container container-pad">
		<div class="full-page">
		<?php if (!isset($_SESSION['valid_user_id'])) {
				if(isset($login_result) && $login_result<0) { ?>
				<div class="msg-error">
					<img src="static/img/error.gif" alt="Error">
					<?echo $msg;?>
				</div>

			<?php } ?>
							    
		        <div class="login_form">
		            <div id="tag">Please Sign In</div>	
		            <form method="post" role="form">

		                <fieldset>
		                    <label for="name">Username</label>
		                    <input type="text" name="name" placeholder="User Name" required="" autofocus="">
		                    <br />
		                    <label for="name">Password</label>
		                    <input type="password" name="password" placeholder="Password" required="">
		                    <br />
		                    <p>
		                        <a id="found-psw" href="register.php">Forgot your password?</a>
		                        <a id="found-psw" href="register.php">Need an account?</a>
		                    </p>
		                    <br />
		                </fieldset>
		                <input type="submit" class="button button-input" name="submit" value="Login">
		            </form>
						

		        </div>

		    
			<?php  } else { 
		        if(isset($login_result) && $login_result>=0) { ?>
					<div class="msg-success">
						<img src="static/img/right.gif" alt="Success">
						<?echo $msg;?>
					</div>
			        <?php  
			        header("Refresh: 3; url=index.php");
		    		}
		    	}
				?>	
		</div>
		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>