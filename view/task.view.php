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

			<div class="view-task">
			<div id='tag'>What's ongoing</div>
			<form id="task-option" action="" method="post" >
				<input type="hidden" name="mode" value="create">
				<input type="submit" class="button button-input" value="New Task">
				<input type="submit" class="button button-input" value="Show all">
				<input type="submit" class="button button-input" value="Ongoing Task">
				<input type="submit" class="button button-input" value="Past Task">
			</form>
			<?php if (!$tasks) {?>
				<div>You don't have any task to do!</div>
			<?php
				} else {
			?>
			<?php
					for ($i = 0; $i < count($tasks); $i++) {
						$remain = $tasks[$i]['remainingslot']*30;
					?>
					<div id="task-item">	
						<div id="task-title">
							<a href=task.php?mode=edit&task_id=<?echo $tasks[$i]['id']?>><?php echo($tasks[$i]['title']);?></a>
						</div>
						<form action="" method="post" id="task-do-form"> 
						<span id="task-status"><?php 
						$progress = floor((1 - $tasks[$i]['remainingslot']/$tasks[$i]['totalslot']) * 100);
						if ($progress<10) {
							echo "0".$progress;
						} else {
							echo $progress;
						}
						?>/100%</span>
							<input type="hidden" name="taskid" value="<?php echo($tasks[$i]['id']) ?>">
						<? if ($remain!=0) { ?>
							<input type="submit" class="button-do" name="submit" value="Do">
						<?}?>
						</form>

						<div id="progressbar">
      						<div id="progressbar-percentage" style="width: <?php echo((1 - $tasks[$i]['remainingslot']/$tasks[$i]['totalslot']) * 100)?>%">
    						</div>
    					</div>
    					<?php 
    					
    					if ($remain!=0) {
    						?>
							<div id="remaining-time">Estimated remaining time: <?echo " $remain mintes"?></div>
    						<?
    					} else {
    						?>
    						<div id="remaining-time">Finished</div>
    						<?
    					}
    					?>
    					

					</div>
					<?php }		
				}
			?>
			</div>

				</div>	
		    </div>
		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>