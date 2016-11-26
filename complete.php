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
		<title>Submission Complete</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="stylesheets/normalize.css" media="screen">
		<link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" media="screen">
		<link rel="icon" href="https://raw.githubusercontent.com/google/material-design-icons/master/av/2x_web/ic_queue_music_black_48dp.png" type="image/png">
	</head>
	<body>
<?
if ($_POST[paid])
{
	$sql = "SELECT * FROM User WHERE name = :name AND ccNum =  :ccNum;";
	$stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$stmt->execute(array(':name' => $_POST['name'], ':ccNum' => $_POST['ccNumber']));
	$result = $stmt->fetch(pdo::FETCH_BOTH);
	if ($result)
	{
		echo "User already in database";
		$uid = $result[userID];
	}
	else
	{
		$sql = "INSERT INTO User(name, ccNum) VALUES(:name, :ccNum);";
		$stmt2 = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$stmt2->execute(array(':name' => $_POST['name'], ':ccNum' => $_POST['ccNumber']));
		echo "User " . $_POST[name] . " has been added to the database with credit card number " . $_POST[ccNumber];
		$uid= $pdo->lastInsertId();
	}
	$time = date('H:i:s', time());
	$sql = "INSERT INTO PaidAdd(userID, fileID, time, amount, played) VALUES(:userID, :fileID, :time, :amount, false);";
	$stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$stmt->execute(array(':userID' => $uid, ':fileID' => $_POST['file'], ':time' => $time, ':amount' => $_POST['amount']));
	echo "<br>Song " . $_POST['file'] . " has been added to the paid queue by user " . $uid . " at " . $time . " for " . $_POST[amount] . " dollars.";
}
else
{
	$sql = "SELECT * FROM User WHERE name = :name;";
	$stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$stmt->execute(array(':name' => $_POST['name']));
	$result = $stmt->fetch(pdo::FETCH_BOTH);
	if ($result)
	{
		echo "User already in database";
		$uid = $result[userID];
	}
	else
	{
		$sql = "INSERT INTO User(name) VALUES(:name);";
		$stmt2 = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$stmt2->execute(array(':name' => $_POST['name']));
		echo "User " . $_POST[name] . " has been added to the database";
		$uid= $pdo->lastInsertId();
	}
	$time = date('H:i:s', time());
	$sql = "INSERT INTO FreeAdd(userID, fileID, time, played) VALUES(:userID, :fileID, :time, false);";
	$stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$stmt->execute(array(':userID' => $uid, ':fileID' => $_POST['file'], ':time' => $time));
	echo "<br>Song " . $_POST['file'] . " has been added to the free queue by user " . $uid . " at " . $time;
}
?>
	</body>
</html>
