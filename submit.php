<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');

$type = get('type');


// If form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if ($_POST['mode'] == "book"){
        $isbn = $_POST['isbn'];
        $title = $_POST['title'];
        $author = $_POST['author'];
        $price = $_POST['price'];
        $url = $_POST['url'];
        $userID = $loggedInUser->get('userID');
        
        $sql = file_get_contents('sql/addBook.sql');
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
            header('location: index.php?success=book');
        } else {
            echo "submission error";
        }
    }
    if ($_POST['mode'] == "movie"){
        $title = $_POST['title'];
        $director = $_POST['director'];
        $leadActor = $_POST['lead_actor'];
        $url = $_POST['url'];
        $userID = $loggedInUser->get('userID');
        
        $sql = file_get_contents('sql/addMovie.sql');
        $params = array(
            'title' => $title,
            'director' => $director,
            'lead_actor' => $leadActor,
            'url' => $url,
            'userID' => $userID
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
        $title = $_POST['title'];
        $studio = $_POST['studio'];
        $price = $_POST['price'];
        $url = $_POST['url'];
        $userID = $loggedInUser->get('userID');
        
        $sql = file_get_contents('sql/addGame.sql');
        $params = array(
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
	
  	<title>Submit Media</title>
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
                <h1>Submit Book</h1>
                <form class="submit-form" action="" method="POST">
                    <div class="form-element">
                        <input name="mode" type="hidden" value="book">
                    </div>
                    <div class="form-element">
                        <label>ISBN:</label>
                            <input type="text" name="isbn" class="textbox" placeholder="ISBN" />
                        
                    </div>
                    <div class="form-element">
                        <label>Title:</label>
                        <input type="text" name="title" class="textbox" placeholder="Title" />
                    </div>
                    
                    <div class="form-element">
                        <label>Author</label>
                        <input type="text" name="author" class="textbox" placeholder="author" />
                    </div>
                    <div class="form-element">
                        <label>Price:</label>
                        <input type="number" step="any" name="price" class="textbox" placeholder="price" />
                    </div>
                    <div class="form-element">
                        <label>Link:</label>
                        <input type="text" name="url" class="textbox" placeholder="Add a link" />
                    </div>

                    <div class="form-element">
                        <input type="submit" class="button" />&nbsp;
                    </div>
                </form>
            </div>
        <?php elseif ($type == "movie") : ?>
            <div class="movie">
                <h1>Submit Movie</h1>
                <form class="submit-form" action="" method="POST">
                    <div class="form-element">
                        <input name="mode" type="hidden" value="movie">
                    </div>

                    <div class="form-element">
                        <label>Title:</label>
                        <input type="text" name="title" class="textbox" placeholder="Title" />
                    </div>
                    
                    <div class="form-element">
                        <label>Director</label>
                        <input type="text" name="director" class="textbox" placeholder="Director" />
                    </div>

                    <div class="form-element">
                        <label>Lead Actor</label>
                        <input type="text" name="lead_actor" class="textbox" placeholder="Lead Actor" />
                    </div>
                    
                    <div class="form-element">
                        <label>Link:</label>
                        <input type="text" name="url" class="textbox" placeholder="Add a link" />
                    </div>

                    <div class="form-element">
                        <input type="submit" class="button" />&nbsp;
                    </div>
                </form>
            </div>
        <?php elseif ($type == "game") : ?>
            <div class="game">
                <h1>Submit Game</h1>
                <form class="submit-form" action="" method="POST">
                    <div class="form-element">
                        <input name="mode" type="hidden" value="game">
                    </div>

                    <div class="form-element">
                        <label>Title:</label>
                        <input type="text" name="title" class="textbox" placeholder="Title" />
                    </div>
                    
                    <div class="form-element">
                        <label>Studio</label>
                        <input type="text" name="studio" class="textbox" placeholder="Studio" />
                    </div>

                    <div class="form-element">
                        <label>Price:</label>
                        <input type="number" step="any" name="price" class="textbox" placeholder="price" />
                    </div>
                    
                    <div class="form-element">
                        <label>Link:</label>
                        <input type="text" name="url" class="textbox" placeholder="Add a link" />
                    </div>

                    <div class="form-element">
                        <input type="submit" class="button" />&nbsp;
                    </div>
                </form>
            </div>
        <?php endif; ?>

    </div>
</body>
</html>