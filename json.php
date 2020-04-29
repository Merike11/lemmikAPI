<?php 
 header("Content-type: application/json; charset=utf-8"); 
 if(isset($_GET['link'])){
     $link=$_GET["link"];
 } else {
     echo "link is not set";
     return;
 
try {
 
   require "./config.php";
   require "./common.php";
 
   $limit = $_GET['limit'];
   
   $connection = new PDO($dsn, $username, $password, $options);
   
   $sql = "SELECT * FROM cache WHERE link='" . $link . "'";
   
   $statement = $connection->prepare($sql);
   $statement->execute();
   
   $result = $statement->fetchAll(PDO::FETCH_ASSOC);
 
   if (sizeof($result)===0){
       $response = file_get_contents($link);
     echo $response;
       $insert = "INSERT INTO cache(link, data) values(:link, :data)";
       $insertStatement=$connection->prepare($insert);
       $insertStatement->execute(["link"=>$link, "data"=>$response]);
   }
   else {
 
       echo json_decode(json_encode($result[0]))->data;
   }
   } catch(PDOException $error) {
   echo $sql . "<br>" . $error->getMessage();
   }

?>