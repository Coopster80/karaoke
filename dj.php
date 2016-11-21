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
                
   <h1>Search By Title Results</h1>
   <div class="search-results">
   <table class="result-table">
    <thead>
     <tr>
        <th>Select</th>
        <th>Title</th>
        <th>Artist</th>
        <th>Contributors</th>
      </tr>
     </thead>
    <tbody>


  </tbody>
 </body>
</html>


