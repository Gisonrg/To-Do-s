<!DOCTYPE html>
	<html lang="en">
	<?php include('common/header.inc');?>
	<body>
		<?php include('common/top.inc');?>
		
		<div class="container container-pad">	
		
			<?php include('common/sidebar.inc');?>

		<div class="content">
			<table class="leaderboard">
				<?php 
					if (count($leaders) == 0) {
						echo "No one here leh";
					} else {
						for ($i = 0; $i < count($leaders); $i++) {
							echo "<tr><td>".$leaders[$i]['name']."</td></tr>";
							echo "<tr><td>Level: ".$leaders[$i]['level']."</td><td>"."total hours: 100"."</td></tr>";
						}
					}
				?>
			</table>
			<br />
			
		</div>			

		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>


