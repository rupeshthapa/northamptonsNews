
<?php
// connecting to the database
$server = "db"; // host is a localhost
$username ="student"; 
$password = "student";
$dbname ="mydb"; // database name on the local database server

//account with the username 'student' and password 'student' can access the 'mydb' database 
$database = new PDO("mysql:host=$server;dbname=$dbname", $username, $password);
 
?>