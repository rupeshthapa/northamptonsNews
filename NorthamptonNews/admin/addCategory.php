<?php

include('../database_connection.php'); // including the file which connects into localhost and into database 
	

	// for adding new category
	if(isset($_POST['add'])){ ////determining if a variable is declared and is different than null 
		$name = $_POST['name']; //getting the entered datas 
		$query ="INSERT INTO category (name)VALUES(:name)"; // query to insert into the database 
		$statements =$database->prepare($query); // preparing the sql query
		$con = [
			':name' => $name,
		]; //checking the field name and database column name
		$statements->execute($con); // executing the prepared sql statement
if($statements){ 
    echo"Category Added...!!!";
    
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
							<!--sending id of the datas entered into the database-->
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
			<h2>Add Category</h2>
			<form action ="addCategory.php" method='POST'>
				<label>Category:</label>
				<input type ="text" name="name" placeholder="Enter new category." required><br>
                <button type="submit" name="add" value="submit" class="button">Sumbit</button>
			</form>
		</article>
	</main>
	<footer>
		&copy; Northampton News 2017
	</footer>
</body>
</html>