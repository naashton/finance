	<footer>
		<div class="container">
		<p>&copy;
		<?php
			date_default_timezone_set("America/New_York");
			$startYear = 2016;
			$thisYear = date('Y');
			if ($startYear == $thisYear) {
				echo $startYear;
			} else {
				echo "$startYear".'&ndash;'."$thisYear";
			}
		?>
		Nick Ashton</p>
		</div>
	</footer>
</div>
</body>
</html>