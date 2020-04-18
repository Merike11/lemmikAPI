<?php include "templates/header.php"; ?><h2>Lisa lemmik:</h2>
<?php



<form method="post" action="" enctype='multipart/form-data' name="paintings">
    	<label for="title">Nimi</label>
    	<input type="text" name="title" id="title">
    	<label for="image">Pilt</label>
    	<input type="file" id="image" name="image"/> 
    	<label for="description">Kirjeldus</label>
    	<input type="text" name="description" id="description">
    	<label for="made_at">Loomise aeg</label>
    	<input type="text" name="made_at" id="made_at">
    	<label for="difficulty">Raskusaste</label>
    	<input type="text" name="difficulty" id="difficulty">
    	<input type="submit" name="but_upload" value="Save name">
	</form>
	
	<a href= "index.php">Tagasi algusesse</a>

<?php include "templates/footer.php"; ?>
