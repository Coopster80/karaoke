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
			if ($_POST[free])
			{
				echo "FREE";
			}
			else
			{
				echo "PAID";
			}
		}
		else
		{
			echo "Please select a song";
		}
		?>
	</body>
</html>
