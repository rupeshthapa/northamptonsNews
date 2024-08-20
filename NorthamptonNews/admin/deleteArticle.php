<?php
ob_start(); //turning on output buffer

include('../database_connection.php'); // including the file which connects into localhost and into database 

if (isset($_POST['delete'])) { //determining if a variable is declared and is different than null 
    //query to delete on button click
    $delete = $database->prepare('DELETE FROM articles WHERE id = :id');
    $delete->execute(['id' => $_POST['id']]);

    header('Location:adminArticle.php');

}
?>