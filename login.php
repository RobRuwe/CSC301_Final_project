<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');

$created = get('created');

// If form submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// Get username and password from the form as variables
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	// Query records that have usernames and passwords that match those in the customers table
	$sql = file_get_contents('sql/Login.sql');
	$params = array(
		'username' => $username
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$users = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	// If $users is not empty
	if(!empty($users)) {
        if(password_verify($password, $users[0]['password'])) {
            
            // Set $user equal to the first result of $users
            $logged_user = $users[0];
		
            // Set a session variable with a key of customerID equal to the customerID returned
            $_SESSION['userID'] = $logged_user['userID'];

			// Redirect to the index.php file
            header('location: index.php');   
        
		}
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
		<h1>Login</h1>
		<?php if($created == 'y') :?>
			<p> Account Created, Please Log In </p>
		<?php endif; ?>
		<form method="POST">
			<input type="text" name="username" placeholder="Username" />
			<input type="password" name="password" placeholder="Password" />
			<input type="submit" value="Log In" />
		</form>
		<p>
			<a href="createAccount.php">New Account</a>
		</p>
	</div>
</body>
</html>