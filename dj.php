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

    <!-- 
     - paid add view
     - These items always come before the free queue items
     - These items should have a different color text or have 
       some visual change to let the DJ know they are the paid ones
    -->
    
    <?
      $sql = "SELECT F.titleID as Title, F.artistID as Artist, A.userID as Name FROM File F, PaidAdd A WHERE F.fileID = A.fileID GROUP BY F.titleID;"
      $prepare = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $prepare->execute(array($result['paid']));
      while ($result = $prepare->fetch(pdo::FETCH_BOTH))
      {
      echo "<tr class='item'><td><input type='radio' name='selected' value='" . "</td><td>" . $result[title] . "</td><td>" . $result[artist] . "</td><td>" . $result[userID] . "</td";
      }
      
    ?>


    <!-- 
     - free add view 
     - Comes after the paid queue items
     - Normal text color?
    -->

    <?
      $sql = "SELECT F.titleID as Title, F.artistID as Artist, A.userID as Name FROM File F, FreeAdd A WHERE F.fileID = A.fileID GROUP BY F.titleID;"
      $prepare = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $prepare->execute(array($result['free']));
      while ($result = $prepare->fetch(pdo::FETCH_BOTH))
      {
      echo "<tr class='item'><td><input type='radio' name='selected' value='" . "</td><td>" . $result[title] . "</td><td>" . $result[artist] . "</td><td>" . $result[userID] . "</td";
      }

    ?>

   </tbody>
 </body>
</html>


