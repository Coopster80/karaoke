<?
include 'creds.php';
try { // if something goes wrong, an exception is thrown
	$dsn = "mysql:host=courses;dbname=z1766022";
	$pdo = new PDO($dsn, $username, $password);
}
catch(PDOexception $e) { // handle that exception
	echo "Connection to database failed: " . $e->getMessage();
}
?>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Karaoke Search</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	</head>
	<body>
		<h1>Karakoe</h1>
		<form method="post" action="results.php">
			<input type="text" name="searchbox">
			<input type="submit" value="Search">
		</form>
	</body>
</html>
