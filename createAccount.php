<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');

// If form submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get username and password from the form as variables
	$username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_pw = password_hash($password, PASSWORD_DEFAULT);
	
	//check for unique username


	// Create account with supplied username and hashed password
	$sql = file_get_contents('sql/createAccount.sql');
	$params = array(
        'username' => $username,
        'password' => $hashed_pw
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	if($statement){
        header("Location: login.php?created=y");
    } else {
        echo "error";
    }
	
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	
  	<title>Login</title>
	<meta name="description" content="The HTML5 Herald">
	<meta name="author" content="SitePoint">

	<link rel="stylesheet" href="css/style.css">

	<!--[if lt IE 9]>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  	<![endif]-->
</head>
<body>
	<div class="page">
		<h1>Create Account</h1>
		<form method="POST">
			<input type="text" name="username" placeholder="Username" />
			<input type="password" name="password" placeholder="Password" />
			<input type="submit" value="Create Account" />
		</form>
		<p>
			<a href="login.php">Log In</a>
		</p>
	</div>
</body>
</html>