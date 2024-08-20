<?php
session_start(); //resuming the session
include('../database_connection.php'); // including the file which connects into localhost and into database 

 //for editing category
 if(isset($_POST['editCategory'])){  // codes run after clicking the edit button 

    
	$id = $_POST['categoryId']; 
	$name = $_POST['name']; 
	
	//for throwing the exception
	 try{ 
		
	$to_edit ="UPDATE category SET name=:name WHERE id = :categoryId"; 
	$sql_preparation =$database->prepare($to_edit); 
	$check = [
		'name' => $name, 
		'categoryId' => $id  
	  
	  ]; 
	  $execution = $sql_preparation->execute($check); 
   
	  if($execution){ 
		include('adminCategories.php');
		exit(0);
	  }
	  else{
		include('editCategories.php'); 
		exit(0);
	  }
	 }
	 //catching and hadling the PDOException properly
	 catch(PDOException $e){ 
		echo $e->getMessage(); 
	 }
  
  }

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/styles.css" type="text/css"/>
		<title>Northampton News - Home</title>
	</head>
	<body>
		<header>
			<section>
				<h1>Northampton News</h1>
			</section>
		</header>
		<nav>
			<ul>
				<li><a href="adminArticle.php">Home</a></li>
				<li><a href="#">Select Category</a>
				<ul>
					<?php
					$sql = "SELECT * FROM category"; // query to select records from the database table 
					$fetch_data = $database->prepare($sql); // excuting the same or similar SQL statement
					$fetch_data->execute(); // database executing the statement
					$fetch_data->setfetchMode(PDO::FETCH_OBJ); // setting the default fetching mode
					$category_result = $fetch_data->fetchALL(); // returning array which contains remaining rows as a result
					if($category_result){ // if array returned 
						foreach($category_result as $category){ // looping the values of an array
						?>
						<br>
						<center>
							<!-- returns id and send through the link-->
							<li><a href="cat.php?id=<?=$category->id;?>"><?=$category->name;?></a></li>; <!-- printing the datas -->
						</center>
						<?php
						}
					}
					?>
					</ul>
				</li>
				<li><a href="addArticle.php">Add Article</a></li>
				<li><a class="articleLink" href="manageAdmins.php">Manage Admin</a></li>
                <li><a class="articleLink" href="adminCategories.php">Manage Categories</a></li>
				<li><a class="articleLink" href="/logout.php" style="margin-right:100px;">Log out</a></li>
			</ul>
		</nav>
		<main>
			<nav>

			</nav>
	
			<?php
			if(isset($_GET['id'])){  // getting id sent from the edit link after clicking on edit link
				$id = $_GET['id'];
				$for_editing = "SELECT * FROM category WHERE id=:id"; // selecting datas from the database table 
				$preparation = $database->prepare($for_editing); // executing sql query
				$data = [':id' => $id]; // checking sent id and database id
				$preparation->execute($data); // executing query 
				$data = $preparation->fetch(PDO::FETCH_ASSOC); //fetching with association methon 
				?>
				<h2>Edit Category</h2>
                <form action ='editCategories.php' method='POST'>
				<input type="hidden" name="categoryId" value = "<?= $data['id']?>"/> <!-- prints id of the article but will be invisible because of hidden-->
                <label>Category:</label>
				<input type ="text" name="name" value="<?=$data['name']?>" required><br><!-- prints previous name of the category-->
                <button type="submit" name="editCategory" value="submit" class="button">sumbit</button>
			</form>
			<?php
			} 
			else{
				echo "<h5>No ID Found</h5>";
			}
			?>
			</article>
		</main>
		<footer>
			&copy; Northampton News 2017
		</footer>
	</body>
</html>