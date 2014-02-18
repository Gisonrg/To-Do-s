<!DOCTYPE html>
	<html lang="en">
	<?php include('common/header.inc');?>
	<body>
		<?php include('common/top.inc');?>
		
		<div class="container container-pad">

			<?php include('common/sidebar.inc');?>
			
			<div class="content">
			<?php if ($er_msg!="") { ?>
				<div class="msg-error">
				<img src="static/img/error.gif" alt="Error">
				<?echo $er_msg;?>
				</div>
			<?php } 
			if ($su_msg!="") { ?>
				<div class="msg-success">
				<img src="static/img/right.gif" alt="Success">
				<?echo $su_msg;?>
				</div>
			<?php header("Refresh: 1.5; url=account.new.php");
			} ?>	

				
			
				<div id="view_account">
				    <h2>Update Your Information</h2>
				    <form method="post" action="">
				        <label for="name">
				            <strong>User Name</strong>
				        </label>
				        <input type="hidden" id="name" name="name" value="<?php echo $row['name'];?>">
				        <input type="text" value="<?php echo $row['name'];?>" disabled>
				        <br/>
				        <label for="email">
				            <strong>E-mail</strong>
				        </label>
				        <input type="email" id="email" name="email" placeholder="E-mail" required="" value="<?php echo $row['email'];?>">
				        <br/>
				        <section id="change_password">
				            <label for="o_password">
				                <strong>Old-Password</strong>
				            </label>
				            <input type="password" id="o_password" name="o_password" placeholder="Old Password">
				            <br/>
				            <label for="n_password">
				                <strong>New-Password</strong>
				            </label>
				            <input type="password" id="n_password" name="n_password" placeholder="New Password">
				            <p>*
				                <strong>Enter the password only if you want to change your password.</strong>
				            </p>
				        </section>
				        <br/>

				        <input type="submit" class="button" name="submit" value="Update">
				    </form>
				</div>
		     


				</div>	
		    </div>
		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>