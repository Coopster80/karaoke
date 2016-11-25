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
   <form id="DJ" method="post" action="dj.php">                
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
    
    <?

     /* 
     - paid add view
     - These items always come before the free queue items
     -  Ordered by amount paid
     - These items should have a different color text or have 
       some visual change to let the DJ know they are the paid ones
     */

      if ($_POST[selected])
      {
        if ($_POST[paid])
        {
          $sql = "SELECT F.titleID as Title, F.artistID as Artist, A.userID as Name FROM File F, PaidAdd A WHERE F.fileID = A.fileID GROUP BY F.titleID;";
          $prepare = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
          $prepare->execute(array($result['paid']));
          while ($result = $prepare->fetch(pdo::FETCH_BOTH))
          {
            echo "<tr class='item'><td><input type='radio' name='selected' value='" . "</td><td>" . $result[title] . "</td><td>" . $result[artist] . "</td><td>" . $result[userID] . "</td";
          }
      
        }

     /* 
     - free add view 
     - Comes after the paid queue items
     - Normal text color?
     */

       else
       {
     
        $sql = "SELECT F.titleID as Title, F.artistID as Artist, A.userID as Name FROM File F, FreeAdd A WHERE F.fileID = A.fileID GROUP BY F.titleID;";
        $prepare = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $prepare->execute(array($result['free']));
        while ($result = $prepare->fetch(pdo::FETCH_BOTH))
        {
           echo "<tr class='item'><td><input type='radio' name='selected' value='" . "</td><td>" . $result[title] . "</td><td>" . $result[artist] . "</td><td>" . $result[userID] . "</td";
        }
 
       }

      }
    ?>

   </tbody>
  </form>
 </body>
</html>


