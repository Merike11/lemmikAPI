<?php

require "./config.php";
require "./common.php";

if (isset($_GET["id"])) {
    try {
        $connection = new PDO($dsn, $username, $password, $options);
        $id = $_GET["id"];

        $sql = "DELETE FROM Favorites.paintings WHERE id = :id";
            
        $statement = $connection->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
            
        $success = "Maal edukalt kustutatud";
  } catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
  }
}

try {
    $connection = new PDO($dsn, $username, $password, $options);
  
    $sql = "SELECT * FROM Favorites.paintings";
  
    $statement = $connection->prepare($sql);
    $statement->execute();
  
    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
?>

<?php require "templates/header.php";?>
<div class="formarea ml-3" >
  <h2>Kustuta maali andmed</h2>

  <table>
      <thead>
          <tr>
              <th>Nr</th>
              <th>Nimi</th>
              <th>fail</th>
              <th>Kirjeldus</th>
              <th>Tegemise aeg</th>
              <th>Raskusaste</th>
          </tr>
      </thead>
      <tbody>
      <?php foreach ($result as $row) : ?>
          <tr>
            <td><?php echo escape($row["id"]); ?></td>
            <td><?php echo escape($row["title"]); ?></td>
            <td><?php echo escape($row["image"]); ?></td>
            <td><?php echo escape($row["description"]); ?></td>
            <td><?php echo escape($row["made_at"]); ?></td>
            <td><?php echo escape($row["difficulty"]); ?></td>
            <td><a href="delete.php?id=<?php echo escape($row["id"]); ?>">Kustuta maali andmed</a></td>
          </tr>
      <?php endforeach; ?>
      </tbody>
  </table>
  <br>
  <a href="index.php">Tagasi algusesse</a>
</div>
<?php require "templates/footer.php";?>