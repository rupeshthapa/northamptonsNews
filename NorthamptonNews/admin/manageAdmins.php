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
					$sql_query = "SELECT * FROM category"; // query to select records from the database table 
					$fetch_data = $database->prepare($sql_query); // excuting the same or similar SQL statement
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
				<a href= "addAdmins.php">Add Admin </a>
			</nav>
			<h2>Admins</h2>
			<?php
			//fetching all the admins name
			$query = "SELECT * FROM admin"; // getting datas from database table query 
			$fetching = $database->prepare($query); // preparing query
			$fetching->execute(); // executing query
			$fetching->setfetchMode(PDO::FETCH_OBJ); // fetching with object method 
			$fetched = $fetching->fetchALL(); // fetching all 
			if($fetched){ // if fetched 
				foreach($fetched as $admin){ // looping value of array
				?>
				<center>
					<h5><?=$admin->id;?></h5>
					<?=$admin->name;?>
					<h2><?=$admin->email;?> </h2>
					<a href= "editAdmin.php?id=<?= $admin->id ;?>" style="text-decoration:none; color:black">Edit</a>
					<form  method="post" action="deleteAdmin.php">
						<input type="hidden" name="id" value="<?=$admin->id ;?>" />
                    	<input type="submit" name="delete" value="Delete" style="margin-top:-60px; margin-left:250px;" />
					</form><br>
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
