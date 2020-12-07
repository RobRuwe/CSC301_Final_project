<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');

// Get search term from URL using the get function
$type = get('type');
	if ($type == ""){$type = "all";}
$term = get('search-term');
$successMSG = get('success');

// Get a list of books using the searchBooks function
// Print the results of search results
// Add a link printed for each book to book.php with an passing the isbn
// Add a link printed for each book to form.php with an action of edit and passing the isbn
if($type == "all"){
	$books = searchBooks($term, $database);
	$movies = searchMovies($term, $database);
	$games = searchGames($term, $database);
}elseif ($type == "books") {
	$books = searchBooks($term, $database);
	$movies = array();
	$games = array();
}elseif ($type == "movies") {
	$books = array();
	$movies = searchMovies($term, $database);
	$games = array();
}elseif ($type == "games") {
	$books = array();
	$movies = array();
	$games = searchGames($term, $database);
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Recommended Media</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
	<div class="page">

		<div class="success-msg">
			<?php if ($successMSG) : ?>
				<p><?php echo $successMSG ?> added successfully!</p>
			<?php endif; ?>
		</div>

		<h1>Recommended Media</h1>
		<form method="GET" class="search-form">
			
			<div class="form-element">
				<input type="text" name="search-term" class="search-term" placeholder="Search..." />
			</div>
			<div class="form-element">
				<label>Media Type:</label>
				<select name="type" class="search-select">
					<option value="all" selected>All</option>
					<option value="books">Books</option>
					<option value="movies">Movies</option>
					<option value="games">Games</option>
				</select>
			</div>
			<input type="submit"/>
		</form>
		<div class="content">
			<?php if(!empty($books)) : ?>
				<div class="books">
					<h2>Books</h2>
					<dl>
						<?php foreach($books as $book) : ?>
							<p class="item">
							<dt>Title: <a href="<?php echo $book['url']; ?>"><?php echo $book['title']; ?></a></dt><br />
							<dt>Author: <?php echo $book['author']; ?> </dt><br />
							<dt>Price: <?php echo $book['price']; ?></dt><br />
							<dt>ISBN: <?php echo $book['isbn']; ?></dt><br />
								<a href="edit.php?type=book&isbn=<?php echo $book['isbn'] ?>">Edit Book</a></dt><br />
							</p>
						<?php endforeach; ?>
					</dl>
					<a href="submit.php?type=book">Submit New Book</a><br />
				</div>
			<?php endif; ?> 
			<?php if(!empty($movies)) : ?>
				<div class="movies">
					<h2>Movies</h2>
					<dl>
						<?php foreach($movies as $movie) : ?>
							<p class="item">
							<dt>Title: <a href="<?php echo $movie['url']; ?>"><?php echo $movie['title']; ?></a></dt><br />
							<dt>Director: <?php echo $movie['director']; ?> </dt><br />
							<dt>Lead Actor: <?php echo $movie['lead_actor']; ?></dt> <br />
								
								<a href="edit.php?type=movie&movieID=<?php echo $movie['movieID'] ?>">Edit Movie</a><br />	
							</p>
						<?php endforeach; ?>
					</dl>
					<a href="submit.php?type=movie">Submit New Movie</a><br />
				</div>
			<?php endif; ?>
			<?php if(!empty($games)) : ?>
				<div class="games">
					<h2>Games</h2>
					<dl>
						<?php foreach($games as $game) : ?>
							<p class="item">
							<dt>Title: <a href="<?php echo $game['title']; ?>"><?php echo $game['title']?></a></dt><br />
							<dt>Studio: <?php echo $game['studio']; ?> </dt><br />
							<dt>Price: <?php echo $game['price']; ?> </dt><br />
								
								<a href="edit.php?type=game&gameID=<?php echo $game['gameID'] ?>">Edit Game</a><br />
							</p>
						<?php endforeach; ?>
					</dl>
					<a href="submit.php?type=game">Submit New Game</a><br />
				</div>
			<?php endif; ?>
		</div>

		<div class="foot">
			<!-- print currently accessed by the current username -->
			<p>Currently logged in as: <?php echo $loggedInUser->get('username') ?></p>
			
			<!-- A link to the logout.php file -->
			<p>
				<a href="logout.php">Log Out</a>
			</p>
		</div>
	</div>
</body>
</html>