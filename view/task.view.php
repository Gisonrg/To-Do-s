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
	

			<form id="task-option" action="" method="post" >
				<input type="hidden" name="mode" value="create">
				<input type="submit" class="button" value="Creating new task">
			</form>


			<table class="view-task">
			<?php if (!$tasks) {?>
				<td>You don't have any task to do!</td>
			<?php
				} else {
			?>
				<tr>
					<th>Title</th>
					<th>Description</th>
					<th>Progress</th>
					<th>EXP</th>
					<th>Option</th>
					<th>Status</th>
				</tr>
				<?php
					for ($i = 0; $i < count($tasks); $i++) {
				?>
						<tr>
						<td><a href=task.php?mode=edit&task_id=<?echo $tasks[$i]['id']?>> <?echo $tasks[$i]['title']?></a></td>
						<td><?echo $tasks[$i]['description'];?></td>
						<td><progress max="100" value="<?echo ((1 - $tasks[$i]['remainingslot']/$tasks[$i]['totalslot']) * 100);?>"></td>
						<td>25</td>
						<?if ($tasks[$i]['remainingslot'] > 0) {?>
							 <td><form action="" method="post">
							 <input type="hidden" name="taskid" value="<?echo $tasks[$i]['id']?>">
							 <input type="submit" class="button block" name="submit" value="Do">
							 </form></td>
							 <td>Ongoing</td>
						<?} else {?>
							 <td></td>
							 <td>Completed</td>
						<?}?>
						</tr>

					<?}
					}?>
				
				</table>
				



				</div>	
		    </div>
		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>