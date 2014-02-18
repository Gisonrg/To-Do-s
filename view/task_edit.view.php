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
			<?php header("Refresh: 1.5; url=task.php");
			} 
			?>	
			
				<div class="task-update">
					<form  method="post" action="" role="form" class="task-form">
						<h2>Updating task</h2>
						<label for="name">Title</label>
						<input type="text" name="title" placeholder="Your task title"  value="<?php echo $task['title'];?>" >
						<br />
						<label id="description">Description</label>
						<textarea name="description" rows="5" placeholder="Your description for the task" required=""><?php echo $task['description'];?></textarea>
						<br/>
						<label for="name">Slot (30 min as a unit)</label>
						<input type="number" name="duration" min="1" max="20" value="<?php echo $task['totalslot'];?>"/>
						<br />
						<input type="submit" name="submit" value="Update">
					</form>
				</div>
		    </div>
		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>