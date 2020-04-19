<?php

if (isset($_POST['submit'])) {
  try {
    require "./config.php";
    require "./common.php";

    $connection = new PDO($dsn, $username, $password, $options);
    $sql = "SELECT *
    FROM Favorites.paintings
    WHERE title = :title";
         

    $title = $_POST['title'];
    $img_path = 'images/';
    $statement = $connection->prepare($sql);
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->execute();
    
    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
 
      <h2>Maalid</h2>

      <table>
        <thead>
  <tr>
    <th>#</th>
    <th>Nimi</th>
    <th>fail</th>
    <th>Kirjeldus</th>
    <th>Tegemise aeg</th>
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
          <td><?php echo escape($row["difficulty"]); ?></td>
        </tr>
       
    <div class="img-block">
        <img src="<?php echo $img_src; ?>" alt="" title="<?php echo $title; ?>" width="300" height="200" class="img-responsive" />
        <p><strong><?php echo $title; ?></strong></p>
    </div>         
      <?php } ?>
        </tbody>
    </table>
    <h4>Siia saab tulema pilt sellest maalist, kunagi!!</h4>
    <?php echo '<img src="'.$image.'" /><br />'; ?>


    <?php } else { ?>
      > No results found for <?php echo escape($_POST['title']); ?>.
    <?php }
  } ?>
<div class="formarea ml-3" > 
  <h2>Leia maal</h2>

  <form method="post">
    <label for="name">Nimetus:</label>
    <input type="text" id="title" name="title">
    <input type="submit" name="submit" value="Kuva tulemus">
  </form>
  <br>
<a href="index.php">Tagasi algusesse</a>

<?php require "templates/footer.php";?>