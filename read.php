<?php


    require "./config.php";
    require "./common.php";

    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
    FROM Favorites.paintings
    WHERE title = :title";
    
    $name = $_POST['title'];
    
    $statement = $connection->prepare($sql);
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->execute();
    
    $result = $statement->fetchAll();
  

?>
<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>

 
      <h2>Pildid</h2>

      <table>
        <thead>
  <tr>
    <th>#</th>
    <th>Nimi</th>
    <th>image</th>
    <th>Kirjeldus</th>
    <th>Maalitud kuupäev</th>
    <th>Raskusaste</th>
  </tr>
        </thead>
        <tbody>
    <?php foreach ($result as $row) { ?>
        <tr>
          <td><?php echo escape($row["id"]); ?></td>
          <td><?php echo escape($row["title"]); ?></td>
          <td><?php echo escape($row["image"]); ?></td>
          <td><?php echo escape($row["description"]); ?></td>
          <td><?php echo escape($row["made_at"]); ?></td>
          <td><?php echo escape($row["difficulty"]); ?> </td>
        </tr>
      <?php } ?>
        </tbody>
    </table>
    <?php } else { ?>
      > No results found for <?php echo escape($_POST['title']); ?>.
    <?php }
  } ?>
<div class="formarea ml-3" > 
  <h2>Pildid</h2>

  <form method="post">
    <label for="title">Nimetus:</label>
    <input type="text" id="name" name="name">
    <input type="submit" name="submit" value="Kuva tulemus">
  </form>
  <br>
  <a href="index.php">Tagasi algusesse</a>
</div>
<?php require "templates/footer.php";?>