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
							<!--returns id and send through the link-->
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
		<?php
		//editing admin
		if(isset($_GET['id'])){ //getting id which was sent from the edit link
			$admin_id = $_GET['id']; 
			$query = "SELECT * FROM admin WHERE id=:admin_id"; // selecting datas from the database table 
			$statement = $database->prepare($query); // executing the sql query
			$data = [':admin_id' => $admin_id]; // checking database id and sent id
			$statement->execute($data); // executing the statement 
			$data = $statement->fetch(PDO::FETCH_ASSOC); //setting the default fetching method which is association method
			?>
			<main>
				<nav>

				</nav>
				<h2>Edit Admin</h2>
				<form action ='db.php' method='POST'>
                <input type="hidden" name="admin_id" value = "<?= $data['id']?>"/> <!-- prints id of the article but will be invisible because of hidden-->
                <label>Name:</label>
                <input type ="text" name="name" value="<?=$data['name']?>" required><br> <!--prints the previous name-->
                <label>Email:</label>
                <input type ="email" name="email" value="<?=$data['email']?>"  required><br> <!-- prints previous email -->
                <label>Password:</label>
                <input type="password" name="password" value="<?=$data['password']?>" required><br><br> <!-- prints previous password in a hash but wont be visible-->
                <button type="submit" name="editAdmin" value="submit" class="button">Sumbit</button>
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