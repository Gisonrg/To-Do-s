<!DOCTYPE html>
	<html lang="en">
	<?php include('common/header.inc');?>
	<body>
		<?php include('common/top.inc');?>
		
		<div class="container container-pad">	
			<div class="full-page">
			<br />
			<span class='tag'>&nbsp;Wat's new&nbsp;</span>
			<table class="view-news">
				<?php
				if (count($events) == 0) {
					echo "no news!";
				} else {
					for ($i = 0; $i < count($events); $i++) {
						echo "<tr><td>".$events[$i]['content']."</td></tr>";
					}
				}

				?>
			</table>
			</div>

		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>