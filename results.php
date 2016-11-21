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
		<title>Karaoke Search Results</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="stylesheets/normalize.css" media="screen">
		<link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" media="screen">
		<link rel="icon" href="https://raw.githubusercontent.com/google/material-design-icons/master/av/2x_web/ic_queue_music_black_48dp.png" type="image/png">
	</head>
	<body>
		<h1>Search Results</h1>
		<div class="search-results">
		<table>
			<tr>
				<th>Title</th>
				<th>Artist</th>
				<th>Contributors</th>
			</tr>
			<?
			$sql = "SELECT T.text AS title, A.name AS artist, F.fileID FROM Artist A, Title T, File F WHERE T.text LIKE ? AND F.titleID = T.titleID AND F.artistID = A.artistID;";
			$stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$stmt->execute(array("%{$_POST['searchbox']}%"));
			while ($result = $stmt->fetch(pdo::FETCH_BOTH))
			{
				echo "<tr><td>" . $result[title] . "</td><td>" . $result[artist] . "</td>";
				$sql = "SELECT C.name, CC.type FROM Contributes CC, File F, Contributor C WHERE CC.fileID = F.fileID AND CC.contribID = C.contribID AND F.fileID = ?;";
				$stmt2 = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$stmt2->execute(array($result['fileID']));
				echo "<td>";
				while ($result2 = $stmt2->fetch(pdo::FETCH_BOTH))
				{
					echo $result2[name] . " ";
				}
				echo "</td>";
			}
			?>
		</table>
		</div>
	</body>
</html>
