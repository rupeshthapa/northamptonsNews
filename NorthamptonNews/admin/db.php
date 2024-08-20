
<?php
include('../database_connection.php');
// for adding admins
if(isset($_POST['submit'])){ //determining if a variable is declared and is different than null 
   
  $name = $_POST['name']; //getting name
  $email = $_POST['email']; //getting email 
  $password = $_POST['password']; //getting password
  $hash = password_hash($password, PASSWORD_DEFAULT); // hashing the password

  $admin_insert_query ="INSERT INTO admin (name, email, password)VALUES(:name,:email,:password)"; //inserting query into database
  
  $statements =$database->prepare($admin_insert_query); //preparing sql query
  
  //checking database column names and fields name
  $con = [
  ':name' => $name,
  ':email' => $email,
  ':password' => $hash
 ]; 
   $statements->execute($con); //executing the prepared sql statment
   
   include('manageAdmins.php'); //takes into Manage Admins page after submitting the details

} 





    //for editing admin
    if(isset($_POST['editAdmin'])){ //determining if a variable is declared and is different than null 
        $id = $_POST['admin_id']; //gets id which data is have to edit 
        $name = $_POST['name']; //gets name entered
        $email = $_POST['email']; //gets email entered
         $password = $_POST['password']; //gets password entered
         $hash = password_hash($password, PASSWORD_DEFAULT); //hash the password using hashing algorithm
        //throws Exceptions
         try{ 
          //update sql query to edit previous datas 
          $editAdmin ="UPDATE admin SET name=:name, email=:email, password=:password WHERE id=:admin_id"; 
        
          $sql_preparing =$database->prepare($editAdmin); 
        
          $field_check = [
            'name' => $name, 
            'email' => $email, 
            'password' => $hash,
            'admin_id' => $id  
          ]; 
      
          $sql_execution = $sql_preparing->execute($field_check); 
          
          if($sql_execution){ 
            echo"Edited Successfully"; 
            include('manageAdmins.php'); 
            exit(0);
          }
          else{
           echo"Not Updated Successfully"; 
            include('editArticle.php'); 
            exit(0);
          }
         }
         //catch exception and handle appropriately 
         catch(PDOException $e){ 
            echo $e->getMessage(); 
         }
      
      }
          
      
      
?>