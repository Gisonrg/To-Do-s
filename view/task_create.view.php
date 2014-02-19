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
		<div id='tag'>Creating new task</div>
				<form  method="post" action="" role="form" class="task-form">
					
					<label for="name">Title</label>
					<input type="text" name="title" placeholder="Your task title" required="required" autofocus="">
					<br/>
					<label for="description">Description</label>
					<textarea  id ="description" name="description" style="text-align:left" rows="5" placeholder="Your description for the task" required=""></textarea>
					<br/>
					<label for="name" id="label-name" size="10">Slot (30 min as a unit)</label>
					<input id="input-number" type="text" name="duration"/>
					<br />
					<br />
					<input type="submit" class="button button-input" name="submit" value="Create">
				</form>
			</div>


				</div>	
		    </div>
		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>