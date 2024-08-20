<?php

include('../database_connection.php'); // including the file which connects into localhost and into database 

if (isset($_POST['delete'])) { //determining if a variable is declared 
    //query to delete on button click
    $adminDelete = $database->prepare('DELETE FROM admin WHERE id = :id');
    $adminDelete->execute(['id' => $_POST['id']]);

    include('manageAdmins.php');

}
?>