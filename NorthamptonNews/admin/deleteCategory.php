<?php
session_start();//resuming the session
include('../database_connection.php'); // including the file which connects into localhost and into database 
  if(isset($_POST['deleteCategory'])){ //following code runs and helps to delete on button click

    
    $id = $_POST['deleteCategory']; // gets admin id 
     try{ // throws exception
        
    $deleting ="DELETE FROM category WHERE id=:id"; // query for deleting
     $preparing =$database->prepare($deleting); // executes the query
    $checking = [
        'id' => $id  
      ]; // checking the id 
      $execution = $preparing->execute($checking); // executing the code
  
      if($execution){ // if executed 
        $_SESSION['message'] = "Deleted Successfully"; // displays message deleted successfully 
        include('adminCategories.php'); // and takes it to delete article page 
        exit(0);
      }
      else{
        $_SESSION['message'] = "Not Deleted"; // if not shows not deleted successfully message
        include('adminCategories.php'); //send to the adminCategories page
        exit(0);
      }
     }
     catch(PDOException $e){ // catching exceptions and handle properly
        echo $e->getMessage(); //getting message
     }
  
  }

?>