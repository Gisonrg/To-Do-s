<!DOCTYPE html>
	<html lang="en">
	<div class="view-news">
			<div id='tag'>What's happening</div>
			<?php
			if (!$events) {
				echo "<section>Nothing is happening around!</section>";
			} else {
				echo "<div class=\"news\"><table id=\"news-table\">";
				for ($i = 0; $i < count($events); $i++) { ?>
					<tr><td><?echo "should have icon here"; ?></td>
						<td class="news-content"><?echo $events[$i]['content']; ?></td>
						<td><?echo $events[$i]['time']; ?></td></tr>
			<?php }
				echo "</table></div>";
			}

			?>
			</div>
		</div>			
	</html>