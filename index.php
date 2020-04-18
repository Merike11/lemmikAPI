<?php include"templates/header.php";?>


    <ul>
      <li>
        <a href="create.php"><strong>Lisa uus</strong></a> - add a favorite
      </li>
      <li>
        <a href="read.php"><strong>Vaata</strong></a> - find a favorite
      </li>
    </ul>
<?php 
try{
  $con = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);
}

catch(PDOException $exception){
  //to handle connection error
  echo "Connection error: " . $exception->getMessage();
}
include "config.php";

$query = "SELECT * FROM Favorites.paintings WHERE id = ?";
$stmt = $con->prepare( $query );

$stmt->bindParam(1, $_GET['id']);
$stmt->execute();

$num = $stmt->rowCount();

if( $num ){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    header("Content-type: image/png");
    print $row['data'];
    exit;
}else{
    
}    

?>