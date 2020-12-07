<?php

// Modify to search Games, Movies
function searchBooks($term, $database) {
	$term = $term . '%';
	$sql = file_get_contents('sql/getBooks.sql');
	$params = array(
		'term' => $term
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$books = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $books;
}

function getBook($isbn, $database) {
	$sql = file_get_contents('sql/getBook.sql');
	$params = array(
		'isbn' => $isbn
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$books = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $books[0];
}

function searchMovies($term, $database) {
	$term = $term . '%';
	$sql = file_get_contents('sql/getMovies.sql');
	$params = array(
		'term' => $term
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$movies = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $movies;
}

function getMovie($movieID, $database) {
	$sql = file_get_contents('sql/getMovie.sql');
	$params = array(
		'movieID' => $movieID
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$movies = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $movies[0];
}

function searchGames($term, $database) {
	$term = $term . '%';
	$sql = file_get_contents('sql/getGames.sql');
	$params = array(
		'term' => $term
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$games = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $games;
}

function getGame($gameID, $database) {
	$sql = file_get_contents('sql/getGame.sql');
	$params = array(
		'gameID' => $gameID
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$games = $statement->fetchAll(PDO::FETCH_ASSOC);
	return $games[0];
}

function get($key) {
	if(isset($_GET[$key])) {
		return $_GET[$key];
	}
	else {
		return '';
	}
}