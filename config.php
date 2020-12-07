<?php

// Connecting to the MySQL database
$user = 'ruwer1';
$password = '0fc65974';

$database = new PDO('mysql:host=csweb.hh.nku.edu;dbname=db_fall20_ruwer1', $user, $password);

// Start the session
session_start();

$current_url = basename($_SERVER['REQUEST_URI']);

// config autoloader
function my_autoloader($class) {
    include 'classes/class.' . $class . '.php';
}

spl_autoload_register('my_autoloader');


if (!($current_url == 'login.php' || $current_url == 'login.php?created=y' || $current_url == 'createAccount.php')){
    if (!isset($_SESSION["userID"])){
        header("Location: login.php");
    }elseif (isset($_SESSION["userID"])) {
	    $loggedInUser = new User($_SESSION['userID'], $database); 
    }
}

