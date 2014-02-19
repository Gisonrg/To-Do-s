<!DOCTYPE html>
	<html lang="en">
	<?php include('common/header.inc');?>
	<body>
		<?php include('common/top.inc');?>
		
		<div class="container container-pad">	
			<div class="full-page">
			<br />
		<div class="view-news">
 			<div id='tag'>Wat's happening</div>
				<?php
				if (!$events ) {
					echo "<section>Nothing is happening around!</section>";
				} else {
					for ($i = 0; $i < count($events); $i++) {
						echo "<section>".$events[$i]['content']."</section>";
					}
				}

				?>
			</div>
			</div>

		<!-- End of container -->	
		</div>
		<?php include('common/footer.inc');?>		
	</body>
</html>