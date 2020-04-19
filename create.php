<?php

if(isset($_POST['submit'])){
    require "./config.php";
    require "./common.php";

    try{
        $connection = new PDO($dsn, $username, $password, $options);
        
        $new_painting =array(
            "title" => $_POST['title'],
            "image" => $_POST['image'],
            "description" => $_POST['description'],
            "made_at" => $_POST['made_at'],
            "difficulty" => $_POST['difficulty']
            );
        $sql = sprintf(
    "INSERT INTO %s (%s) values (%s)",
    "Favorites.paintings",
    implode(", ", array_keys($new_painting)),
    ":" . implode(", :", array_keys($new_painting))
        );
        $statement = $connection->prepare($sql);
        $statement->execute($new_painting);

        } catch(PDOException $error) {
        echo $sql ."<br>" . $error->getMessage();
    }
}
?>
<?php require "templates/header.php";?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  <?php echo escape($_POST['title']); ?> successfully added.
<?php } ?> 
<div class="formarea ml-3" >
    <h2>Lisa maal</h2>

    <form method="POST">
        <label for="name">Nimetus:</label>
        <input type="text" name="title" id="title">
        <label for="name">fail:</label>
        <input type="text" name="image" id="image">
        <label for="name">Kirjeldus:</label>
        <input type="text" name="description" id="description"> 
        <label for="name">tegemise aeg:</label>
        <input type="text" name="made_at" id="made_at">
        <label for="name">Raskusaste:</label>
        <input type="text" name="difficulty" id="difficulty">
        <input type="submit" name="submit" value="Kinnita">
    </form>
    <br>
    <a href="index.php">Tagasi algusesse</a>
</div>
<?php require "templates/footer.php";?>
