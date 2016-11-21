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
 <body>
                
   <h1>Result list</h1>
   <div class="results">
   <table class="result-table">
    <thead>
     <tr>
        <th>Select</th>
        <th>Title</th>
        <th>Artist</th>
        <th>Name</th>
      </tr>
     </thead>
    <tbody>

    <!-- paid add view -->
    <?
      $sql = "SELECT F.titleID as Title, F.artistID as Artist, A.userID as Name FROM File F, PaidAdd A WHERE F.fileID = A.fileID GROUP BY F.titleID;"
      $result = $pdo->query($sql);
    ?>


    <!-- free add view -->
    <?
      $sql = "SELECT F.titleID as Title, F.artistID as Artist, A.userID as Name FROM File F, FreeAdd A WHERE F.fileID = A.fileID GROUP BY F.titleID;"
      $result = $pdo->query($sql);
    ?>

   </tbody>
 </body>
</html>


