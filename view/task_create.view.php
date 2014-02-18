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
			<?php header("Refresh: 1.5; url=index.php");
			} ?>	

		<div class="task-create">
				<form  method="post" action="" role="form" class="task-form">
					<h2>Creating new task</h2>
					<label for="name">Title</label>
					<input type="text" name="title" placeholder="Your task title" required="required" autofocus="">
					<br/>
					<label for="name">Description</label>
					<textarea name="description" rows="5" placeholder="Your description for the task" required=""></textarea>
					<br/>
					<label for="name">Slot (30 min as a unit)</label>
					<input type="number" name="duration" min="1" max="20" />
					<br />
					<input type="submit" name="submit" value="Create">
				</form>
			</div>


				</div>	
		    </div>
		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>