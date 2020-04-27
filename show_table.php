<?php

try {
  require "./config.php";
  require "./common.php";

  $connection = new PDO($dsn, $username, $password, $options);
  $sql = "SELECT * FROM Favorites.paintings";
       
  $statement = $connection->prepare($sql);
  $statement->execute();
  
  
  $result = $statement->fetchAll();
  } catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}
?>

<?php require "templates/header.php"; ?>
<div class="formarea ml-3" >

  <h2>Maalid:</h2>

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
            <td><a href="update-single.php?id=<?php echo escape($row["id"]); ?>">Muuda</a></td>
          </tr>
      <?php endforeach; ?>
      </tbody>
  </table>
  <br>  
  <a href="index.php">Tagasi algusesse</a>
</div>
<?php require "templates/footer.php"; ?>