<!DOCTYPE html>
	<html lang="en">
	<?php include('common/header.inc');?>
	<body>
		<?php include('common/top.inc');?>
		
		<div class="container container-pad">	
		
			<?php include('common/sidebar.inc');?>

		<div class="content">
			<div class="view-leaderboard">
			<table>
				<?php 
					if (count($leaders) == 0) {
						echo "No one here leh";
					} else {
						for ($i = 0; $i < count($leaders); $i++) {
							echo "<tr><td><img class=\"leaderboard-icon\" src=\"static\img\\no".($i+1).".png\"></td>";
							echo "<td>&nbsp;&nbsp;&nbsp;".$leaders[$i]['name']."</td>";
							echo "<td>&nbsp;&nbsp;&nbsp;&nbsp;Level: ".$leaders[$i]['level']."</td></tr>";
						}
					}
				?>
			</table>
			<br />
		</div>			
		</div>			

		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>


