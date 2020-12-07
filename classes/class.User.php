<?php

class User {
    // Properties
    public $username;
    private $userID;
    private $database;

    function __construct($userID, $database)
    {
     

    $sql = file_get_contents('sql/getUser.sql');
	$params = array(
		'userID' => $userID
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$users = $statement->fetchAll(PDO::FETCH_ASSOC);
	
    $logged_user = $users[0];

    $this->userID = $userID;
    $this->database = $database;
    $this->username = $logged_user['username'];

    }
   
    function get($key) {
        return $this->$key;
    }
    
    function set($key, $value) {
        $this->$key = $value;
    }

}
