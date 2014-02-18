<!DOCTYPE html>
	<html lang="en">
	<?php include('common/header.inc');?>
	<body>
		<?php include('common/top.inc');?>
		
		<div class="container container-pad">	
			<?php include('common/sidebar.inc');?>

		<div class="content">
			<table class="view-task">
			<span class='tag'>&nbsp;Wat's new&nbsp;</span>
			<?php if (!$tasks) {?>
				<td>You don't have any task to do!</td>
			<?php
				} else {
			?>
			<?php
					for ($i = 0; $i < count($tasks); $i++) {
					?>
						<tr>
						<td><a href=task.php?task_id="<?php echo($tasks[$i]['id']);?>"><?php echo($tasks[$i]['title']);?></a></td>
						<td><progress max="100" value="<?php echo((1 - $tasks[$i]['remainingslot']/$tasks[$i]['totalslot']) * 100)?>"></td>
						<td><form action="" method="post">
						<input type="hidden" name="taskid" value="<?php echo($tasks[$i]['id']) ?>">
						<input type="submit" name="submit" value="do">
						</form></td>
						</tr>
					<?php }		
				}
			?>
			</table>
			<br />
			<span class='tag'>&nbsp;Wat's new&nbsp;</span>
			<table class="view-news">
			<?php
			if (count($events) == 0) {
				echo "Nothing is happening!";
			} else {
				for ($i = 0; $i < count($events); $i++) { ?>
					<tr><td><?php echo $events[$i]['content'];?></td></tr>
			<?php }
			}

			?>
			</table>
		</div>			

		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>