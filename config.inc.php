<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hireandfire";

try {
    	$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8" , $username, $password);
		
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
    }
catch(PDOException $e)
    {
    	die("OOPs something went wrong");
    }

?>