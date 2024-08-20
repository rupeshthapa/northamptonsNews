<?php
include('../database_connection.php'); // including the file which connects into localhost and into database 
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
							<li><a href="cat.php?id=<?=$category->id;?>"><?=$category->name;?></a></li>; <!-- printing the datas and sending id of the article through categories name-->
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
				<a href= "addCategory.php">Add Category </a>
			</nav>
			<h2>Categories</h2>
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
					<h5><?=$category->id;?></h5>
					<?=$category->name;?>
					<a href= "editCategories.php?id=<?= $category->id ;?>" style="text-decoration:none; color:black">Edit</a> <!--sending id to edit from edit link -->
					<form action = "deleteCategory.php" method = "POST">
						<!-- sending id through button to delete-->
						<button type="submit" name="deleteCategory"  value="<?=$category->id ;?>" style="border-radius:10px; width:80px; height:40px; margin-top:-100px">Delete</button> 
					</form>
				</center>
				<?php
				}
			}
			?>
			</main>
			<footer>
				&copy; Northampton News 2017
			</footer>
</body>
</html>