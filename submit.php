<html>
	<head>
		<meta charset="UTF-8">
		<title>Karaoke Submission</title>
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
			if ($_POST[free]) //Devin: Check the syntax on these statements I suck at them
			{
				echo "<h1>Free Queue Submission</h1>";
                                echo "<p>Enter your name:  <input type=\"text\" name=\"freeUsername\"></p>";
                                echo "<input type=\"submit\" name=\"free\" value=\"Submit\" form=\"complete\">";
			}
			else
			{
				echo "<h1>Paid Queue Submission</h1>";
                                echo "<p>Enter your name: <input type=\"text\" name=\"paidUsername\"></p>";
                                echo "<input type=\"submit\" name=\"paid\" value=\"Submit\" form=\"complete\">";
                                //Drop down menu with how much they are going to pay? Or just a text box with the amount....
                                echo "<p>Credit card number:  <input type=\"text\" name=\"ccNumber\"></p>";
                                echo "<input type=\"submit\" name=\"paid\" value=\"Submit\" form=\"complete\">";
			}
		}
		else
		{
			echo "Please select a song";
			echo "<br><a href='search.php'>Back to Search</a>";
		}
		?>
	</body>
</html>
