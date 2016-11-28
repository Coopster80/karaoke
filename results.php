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
		<title>Search Results</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="stylesheets/normalize.css" media="screen">
		<link rel="stylesheet" type="text/css" href="stylesheets/stylesheet.css" media="screen">
		<link rel="icon" href="https://raw.githubusercontent.com/google/material-design-icons/master/av/2x_web/ic_queue_music_black_48dp.png" type="image/png">
	</head>
	<body class="grey">
		<div class="top-buffer"></div>
		<div class="banner">
			<h1 class="banner-title">Search Results</h1>
		</div>
<?
if ( ! empty($_POST['searchbox'])) {
	$results = $_POST['searchbox'];
}
echo '<form id="Form1" action="results.php" method="POST"><input type="hidden" name="searchbox" value='.$results.'></form>';
?>
		<form id="Form2" method="post" action="submit.php">
			<h1 class="table-header">Search by Title</h1>
			<div class="card">
				<table class="result-table">
					<thead>
						<tr>
							<th>Select</th>
							<th>
<?
//start title sort
if ($_POST[title] == "Title ↓")
{
	echo '<input type="submit" class="sort-button" value="Title &uarr;" name="title" class="title" form="Form1"/>';
	$sql =  "SELECT T.text AS title, A.name AS artist, F.fileID FROM Artist A, Title T, File F WHERE T.text LIKE ? AND F.titleID = T.titleID AND F.artistID = A.artistID ORDER BY title DESC;";
}
else
{
	echo '<input type="submit" class="sort-button" value="Title &darr;" name="title" class="title" form="Form1"/>';
	$sql =  "SELECT T.text AS title, A.name AS artist, F.fileID FROM Artist A, Title T, File F WHERE T.text LIKE ? AND F.titleID = T.titleID AND F.artistID = A.artistID ORDER BY title ASC;";
}
//end title sort
?>
							</th>
							<th>Artist</th>
							<th>Contributors</th>
						</tr>
					</thead>
					<tbody>
<?
$stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$stmt->execute(array("%{$_POST['searchbox']}%"));
while ($result = $stmt->fetch(pdo::FETCH_BOTH))
{
	$sql = "SELECT C.name, CC.type FROM Contributes CC, File F, Contributor C WHERE CC.fileID = F.fileID AND CC.contribID = C.contribID AND F.fileID = ?;";
	$stmt2 = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$stmt2->execute(array($result['fileID']));
	echo "<tr class='item'>";
	echo "<td><label class='row-item' for='" . $result['fileID'] . "'><input type='radio' name='selected' value='" . $result['fileID'] . "' id='" . $result['fileID'] . "'></label></td>";
	echo "<td><label class='row-item' for='" . $result['fileID'] . "'>" . $result[title] . "</label></td>";
	echo "<td><label class='row-item' for='" . $result['fileID'] . "'>" . $result[artist] . "</label></td>";
	echo "<td><label class='row-item' for='" . $result['fileID'] . "'>";
	while ($result2 = $stmt2->fetch(pdo::FETCH_BOTH))
	{
		echo $result2[name] . '(' . $result2[type] . ") ";
	}
	echo "</label></td></tr>";
}
?>
					</tbody>
				</table>
			</div>
			<h1 class="table-header">Search by Artist</h1>
			<div class="card">
				<table class="result-table">
					<thead>
						<tr>
							<th>Select</th>
							<th>
<?
//start artist sort
if ($_POST[artist] == "Artist ↓")
{
	echo '<input type="submit" class="sort-button" value="Artist &uarr;" name="artist" class="artist" form="Form1"/>';
	$sql =   "SELECT T.text AS title, A.name AS artist, F.fileID FROM Artist A, Title T, File F WHERE A.name LIKE ? AND F.titleID = T.titleID AND F.artistID = A.artistID ORDER BY title DESC;";
}
else
{
	echo '<input type="submit" class="sort-button" value="Artist &darr;" name="artist" class="artist" form="Form1"/>';
	$sql =  "SELECT T.text AS title, A.name AS artist, F.fileID FROM Artist A, Title T, File F WHERE A.name LIKE ? AND F.titleID = T.titleID AND F.artistID = A.artistID ORDER BY title ASC;";
}
//end artist sort
?>
							</th>
							<th>Title</th>
							<th>Contributors</th>
						</tr>
					</thead>
					<tbody>
<?
$stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$stmt->execute(array("%{$_POST['searchbox']}%"));
while ($result = $stmt->fetch(pdo::FETCH_BOTH))
{
	$sql = "SELECT C.name, CC.type FROM Contributes CC, File F, Contributor C WHERE CC.fileID = F.fileID AND CC.contribID = C.contribID AND F.fileID = ?;";
	$stmt2 = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$stmt2->execute(array($result['fileID']));
	echo "<tr class='item'>";
	echo "<td><label class='row-item' for='" . $result['fileID'] . "'><input type='radio' name='selected' value='" . $result['fileID'] . "' id='" . $result['fileID'] . "'></label></td>";
	echo "<td><label class='row-item' for='" . $result['fileID'] . "'>" . $result[artist] . "</label></td>";
	echo "<td><label class='row-item' for='" . $result['fileID'] . "'>" . $result[title] . "</label></td>";
	echo "<td><label class='row-item' for='" . $result['fileID'] . "'>";
	while ($result2 = $stmt2->fetch(pdo::FETCH_BOTH))
	{
		echo $result2[name] . '(' . $result2[type] . ") ";
	}
	echo "</label></td></tr>";
}
?>
					</tbody>
				</table>
			</div>
			<h1 class="table-header">Search by Contributor</h1>
			<div class="card">
				<table class="result-table">
					<thead>
						<tr>
							<th>Select</th>
							<th>
<?
//start contributor sort
if ($_POST[cont] == "Contributor ↓")
{
	echo '<input type="submit" class="sort-button" value="Contributor &uarr;" name="cont" class="cont" form="Form1"/>';
	$sql = "SELECT C.name, CC.type, F.fileID FROM Contributes CC, File F, Contributor C WHERE CC.fileID = F.fileID AND CC.contribID = C.contribID AND C.name LIKE ? ORDER BY C.name DESC;";
}
else
{
	echo '<input type="submit" class="sort-button" value="Contributor &darr;" name="cont" class="cont" form="Form1"/>';
	$sql =   "SELECT C.name, CC.type, F.fileID FROM Contributes CC, File F, Contributor C WHERE CC.fileID = F.fileID AND CC.contribID = C.contribID AND C.name LIKE ? ORDER BY C.name ASC;";
}
//end contributor sort
?>
							</th>
							<th>Title</th>
							<th>Artist</th>
						</tr>
					</thead>
					<tbody>
<?
$stmt = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
$stmt->execute(array("%{$_POST['searchbox']}%"));
while ($result = $stmt->fetch(pdo::FETCH_BOTH))
{
	$sql = "SELECT T.text AS title, A.name AS artist FROM Title T, File F, Artist A WHERE F.titleID = T.titleID and F.artistID = A.artistID AND F.fileID = ?;";
	$stmt2 = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
	$stmt2->execute(array($result['fileID']));
	$result2 = $stmt2->fetch(pdo::FETCH_BOTH);
	echo "<tr class='item'>";
	echo "<td><label class='row-item' for='" . $result['fileID'] . "'><input type='radio' name='selected' value='" . $result['fileID'] . "' id='" . $result['fileID'] . "'></label></td>";
	echo "<td><label class='row-item' for='" . $result['fileID'] . "'>" . $result[name] . '(' . $result[type] . ") </label></td>";
	echo "<td><label class='row-item' for='" . $result['fileID'] . "'>" . $result2[title] . "</label></td>";
	echo "<td><label class='row-item' for='" . $result['fileID'] . "'>" . $result2[artist] . "</label></td></tr>";
}
?>
					</tbody>
				</table>
			</div>
			<div class="bottom-buffer"></div>
			<div class="bottom-bar">
				<input type="submit" class="result-submit" name="paid" value="Paid Queue" form="Form2">
				<input type="submit" class="result-submit" name="free" value="Free Queue" form="Form2">
			</div>
		</form>
	</body>
</html>
