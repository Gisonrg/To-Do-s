<!DOCTYPE html>
	<html lang="en">
	<?php include('common/header.inc');?>
	<body>
		<?php include('common/top.inc');?>
		
		<div class="container container-pad">	
		
			<?php include('common/sidebar.inc');?>

		<div class="content">
			<div class="view-task">
			<div id='tag'>What's ongoing</div>
			<?php if (!$tasks) {?>
				<div id='warn'>You don't have any task to do!</div>
			<?php
				} else {
			?>
			<?php
					for ($i = 0; $i < count($tasks); $i++) {
					?>
					<div id="task-item">	
						<div id="task-title">
							<a href=task.php?mode=edit&task_id=<?echo $tasks[$i]['id']?>><?php echo($tasks[$i]['title']);?></a>
						</div>
						<span id="task-status"><?php echo floor((1 - $tasks[$i]['remainingslot']/$tasks[$i]['totalslot']) * 100)?>/100%</span>
						<form action="" method="post" id="task-do-form"> 
							<input type="hidden" name="taskid" value="<?php echo($tasks[$i]['id']) ?>">
							<input type="submit" class="button-do" name="submit" value="Do">
						</form>

						<div id="progressbar">
      						<div id="progressbar-percentage" style="width: <?php echo((1 - $tasks[$i]['remainingslot']/$tasks[$i]['totalslot']) * 100)?>%">
    						</div>
    					</div>

    					<div id="remaining-time">Estimated remaining time: <?php echo ($tasks[$i]['remainingslot']*30)." minutes"?></div>
					</div>
					<?php }		
				}
			?>
			</div>
			<br />
			<br />
			<?php require('news.view.php'); ?>

		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>