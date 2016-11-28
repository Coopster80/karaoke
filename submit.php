<html>
	<head>
		<meta charset="UTF-8">
		<title>Queue Submission</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="stylesheets/normalize.css" media="screen">
		<link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" media="screen">
		<link rel="icon" href="https://raw.githubusercontent.com/google/material-design-icons/master/av/2x_web/ic_queue_music_black_48dp.png" type="image/png">
	</head>
	<body>
		<form method="post" action="complete.php">
		<?
		if ($_POST[selected])
		{
			echo "<input type='hidden' name='file' value='" . $_POST[selected] . "'>";
			if ($_POST[free])
			{
				echo "<div class='top-buffer'></div>";
				echo "<div class='banner'>";
				echo "<h1 class='banner-title'>Free Submission</h1>";
				echo "</div>";
				echo "<p>Name: <input type='text' name='name'></p>";
				echo "<input type='submit' name='free' value='Submit'>";
			}
			else
			{
				echo "<div class='top-buffer'></div>";
				echo "<div class='banner'>";
				echo "<h1 class='banner-title'>Paid Submission</h1>";
				echo "</div>";
				echo "<p>Name: <input type='text' name='name'></p>";
				echo "<p>Credit Card Number: <input type='text' name='ccNumber'></p>";
				echo "<p>Amount: <input type='text' name='amount'></p>";
				echo "<input type='submit' name='paid' value='Submit'>";
			}
		}
		else
		{
			echo "<h1>Please select a song</h1>";
			echo "<br><a href='search.php'>Back to Search</a>";
		}
		?>
		</form>
	</body>
</html>
