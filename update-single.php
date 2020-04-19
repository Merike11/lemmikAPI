<?php

require "./config.php";
require "./common.php";

if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $painting =[
      "id"          => $_POST['id'],
      "title"       => $_POST['title'],
      "image"       => $_POST['image'],
      "description" => $_POST['description'],
      "made_at"     => $_POST['made_at'],
      "difficulty"  => $_POST['difficulty']
    ];
    $sql = "UPDATE Favorites.paintings
            SET id = :id,
              title = :title,
              image = :image,
              description = :description,
              made_at = :made_at,
              difficulty = :difficulty
            WHERE id = :id";

  $statement = $connection->prepare($sql);
  $statement->execute($painting);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];
    $sql = "SELECT * FROM Favorites.paintings WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $painting = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php";?>
<div class="formarea ml-3" >
  <?php if (isset($_POST['submit']) && $statement) : ?>
    <?php echo escape($_POST['title']); ?> successfully updated.
  <?php endif; ?>
  <h2>Muuda maali andmed:</h2>

    <form method="post">
      <?php foreach ($painting as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
      <?php endforeach; ?>
      <input type="submit" name="submit" value="Kinnita">
    </form>
</div>    
  <br>
<a href="index.php">Tagasi algusesse</a>

<?php require "templates/footer"; ?>