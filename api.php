<?php

try {
  require "./config.php";
  require "./common.php";

  $limit = $_GET['limit'];
  
  $connection = new PDO($dsn, $username, $password, $options);
  $sql = "SELECT * FROM Favorites.paintings";
  
  if(ctype_digit($limit)){
      $sql .=' limit ' . $limit;
  }
  $statement = $connection->prepare($sql);
  $statement->execute();
  
  $result = $statement->fetchAll(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
header("Content-type: application/json; charset=utf-8"); 
echo json_encode($result);

?>

