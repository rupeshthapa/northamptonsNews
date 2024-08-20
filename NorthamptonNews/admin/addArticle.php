<?php
session_start(); //resuming the session
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
				<article>
					<?php
					if (isset($_POST['add_article'])) { //checking variable is set or not also if add article button is clicked runs following codes
						$title = $_POST['title']; // getting title entered by the admin
						$categoryId = $_POST['categoryId']; // getting category id from the category table
						$content = $_POST['content']; // getting content entered by the admin
						$date = Date('y-m-d H:m:s'); // current date and time
						$adminId = $_SESSION['name']; // name of the admin who has logged in
						$inserting_query = $database->prepare('INSERT INTO articles (title, categoryId, content, publishDate, adminId) 
							    VALUES (?, ?, ?, ?, ?)'); // inserting query which helps to insert entered datas into the database table
								$inserting_query->execute([$title,$categoryId,$content,$date,$adminId]); // database executing the statement

								// image inserting query 
								if ($_FILES['image']['error'] == 0) {
									$fileName = $database->lastInsertId() . '.jpg'; //insert image as .jpg
									move_uploaded_file($_FILES['image']['tmp_name'], '../images/article/' . $fileName); // images will be inserted into the article folder which is inside the image folder
								}
								echo 'Article added';
							}
							?>
							<h2>Add Article</h2>
							<form action ='addArticle.php' method ='POST' enctype="multipart/form-data">
								<label>Title</label> <input type="text" name="title" placeholder = "Enter the title." required/>
								<label>Category</label>
								<select name="categoryId">
									<?php
									$category = $database->prepare('SELECT * FROM category'); // selecting records from the database table
									$category->execute(); // database executing the statement
									foreach ($category as $categories) { // looping the values of an array
										echo '<option value="' . $categories['id'] . '">' . $categories['name'] . '</option>'; // fetching the datas
									}
									?>
									</select>
									<label>Article</label>
									<textarea type="text" name="content" placeholder = "Write the article." required></textarea>
									<label>Image</label>
									<input type="file" name="image" />
									<input type="submit" name="add_article" value="Add Article" />
								</form>
							</article>
						</main>
						<footer>
							&copy; Northampton News 2017
						</footer>
	</body>
</html>
