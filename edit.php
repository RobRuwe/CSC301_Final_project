<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');

$type = get('type');
$isbn = get('isbn');
$movieID = get('movieID');
$gameID = get('gameID');

if ($isbn != ""){
	$book = getBook($isbn, $database);
} elseif ($movieID != "") {
	$movie = getMovie($movieID, $database);
} elseif ($gameID != "") {
	$game = getgame($gameID, $database);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//echo "post" ; print_r($_POST);
	// These could be functions themselves
	if ($_POST['mode'] == "book"){
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $price = $_POST['price'];
        $url = $_POST['url'];
        $userID = $loggedInUser->get('userID');
		
        $sql = file_get_contents('sql/updateBook.sql');
        $params = array(
            'isbn' => $isbn,
            'author' => $author,
            'title' => $title,
            'price' => $price,
            'url' => $url,
            'userID' => $userID
        );
    
        $statement = $database->prepare($sql);
        $statement->execute($params);
        
        if ($statement){
			echo "updated!";
			header('location: index.php?success=book');
        } else {
            echo "submission error";
        }
    }
    if ($_POST['mode'] == "movie"){
		$movieID = $_POST['movieID'];
        $title = $_POST['title'];
        $director = $_POST['director'];
        $leadActor = $_POST['lead_actor'];
        $url = $_POST['url'];
        $userID = $loggedInUser->get('userID');
        
        $sql = file_get_contents('sql/updateMovie.sql');
        $params = array(
            'title' => $title,
            'director' => $director,
            'lead_actor' => $leadActor,
            'url' => $url,
			'userID' => $userID,
			'movieID' => $movieID
        );
    
        $statement = $database->prepare($sql);
        $statement->execute($params);
        
        if ($statement){
            header('location: index.php?success=movie');
        } else {
            echo "submission error";
        }
    }
    if ($_POST['mode'] == "game"){
		$gameID = $_POST['gameID'];
        $title = $_POST['title'];
        $studio = $_POST['studio'];
        $price = $_POST['price'];
        $url = $_POST['url'];
        $userID = $loggedInUser->get('userID');
        
        $sql = file_get_contents('sql/updateGame.sql');
        $params = array(
			'gameID' => $gameID,
            'title' => $title,
            'studio' => $studio,
            'price' => $price,
            'url' => $url,
            'userID' => $userID
        );
    
        $statement = $database->prepare($sql);
        $statement->execute($params);
        
        if ($statement){
            header('location: index.php?success=game');
        } else {
            echo "submission error";
        }
    }

}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Edit Media</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
	<div class="page">
		<?php if($type == "book") : ?>
            <div class="book">
                <h1>Edit Book</h1>
                <form class="edit-form" action="" method="POST">
                    <div class="form-element">
                        <input name="mode" type="hidden" value="book">
                    </div>
                    <div class="form-element">
                            <input type="hidden" name="isbn" class="textbox" value="<?php echo $book['isbn'] ?>" />
                        
                    </div>
                    <div class="form-element">
                        <label>Title:</label>
                        <input type="text" name="title" class="textbox" value="<?php echo $book['title'] ?>" />
                    </div>
                    
                    <div class="form-element">
                        <label>Author</label>
                        <input type="text" name="author" class="textbox" value="<?php echo $book['author'] ?>" />
                    </div>
                    <div class="form-element">
                        <label>Price:</label>
                        <input type="number" step="any" name="price" class="textbox" value="<?php echo $book['price'] ?>" />
                    </div>
                    <div class="form-element">
                        <label>Link:</label>
                        <input type="text" name="url" class="textbox" value="<?php echo $book['url'] ?>" />
                    </div>

                    <div class="form-element">
                        <input type="submit" class="button" />&nbsp;
                    </div>
                </form>
            </div>
        <?php elseif ($type == "movie") : ?>
            <div class="movie">
                <h1>Edit Movie</h1>
                <form class="edit-form" action="" method="POST">
                    <div class="form-element">
                        <input name="mode" type="hidden" value="movie">
					</div>
					
					<div class="form-element">
                        <input type="hidden" name="movieID" class="textbox" value="<?php echo $movie['movieID'] ?>" />
                    </div>

                    <div class="form-element">
                        <label>Title:</label>
                        <input type="text" name="title" class="textbox" value="<?php echo $movie['title'] ?>" />
                    </div>
                    
                    <div class="form-element">
                        <label>Director</label>
                        <input type="text" name="director" class="textbox" value="<?php echo $movie['director'] ?>" />
                    </div>

                    <div class="form-element">
                        <label>Lead Actor</label>
                        <input type="text" name="lead_actor" class="textbox" value="<?php echo $movie['lead_actor'] ?>" />
                    </div>
                    
                    <div class="form-element">
                        <label>Link:</label>
                        <input type="text" name="url" class="textbox" value="<?php echo $movie['url'] ?>" />
                    </div>

                    <div class="form-element">
                        <input type="submit" class="button" />&nbsp;
                    </div>
                </form>
            </div>
        <?php elseif ($type == "game") : ?>
            <div class="game">
                <h1>Edit Game</h1>
                <form class="edit-form" action="" method="POST">
                    <div class="form-element">
                        <input name="mode" type="hidden" value="game">
					</div>
					
					<div class="form-element">
                        <input type="hidden" name="gameID" class="textbox" value="<?php echo $game['gameID'] ?>" />
                    </div>
					
					<div class="form-element">
                        <label>Title:</label>
                        <input type="text" name="title" class="textbox" value="<?php echo $game['title'] ?>" />
                    </div>
                    
                    <div class="form-element">
                        <label>Studio</label>
                        <input type="text" name="studio" class="textbox" value="<?php echo $game['studio'] ?>" />
                    </div>

                    <div class="form-element">
                        <label>Price:</label>
                        <input type="number" step="any" name="price" class="textbox" value="<?php echo $game['price'] ?>" />
                    </div>
                    
                    <div class="form-element">
                        <label>Link:</label>
                        <input type="text" name="url" class="textbox" value="<?php echo $game['url'] ?>" />
                    </div>

                    <div class="form-element">
                        <input type="submit" class="button" />&nbsp;
                    </div>
                </form>
            </div>
		<?php endif; ?>
		
		<p><a href="index.php">Go Back</a></p>
	</div>
</body>
</html>