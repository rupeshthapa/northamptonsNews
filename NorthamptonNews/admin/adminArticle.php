<?php

session_start(); //resuming the session
include('../database_connection.php'); //using database parameters
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
		<img src="../images/banners/randombanner.php" />
		<?php
			if (isset($_SESSION['name'])){ // after loggedin gets the name who has logged in 
				$admin = $_SESSION['name'];
				echo '<center><h2>Welcome'. ' ' . $admin . '</h1></center>';
			}
		
		?>
		<?php
		//fetching all the articles
		$queries = $database->prepare('SELECT * FROM articles'); // selecting records of articles table from the database
		
		$cat = $database->prepare('SELECT * FROM category WHERE id = :id'); // selecting category from the database
		
		$queries->execute(); // database executing the query 
		
		foreach ($queries as $article) { //looping values of an array
			$cat->execute(['id' => $article['categoryId']]); // executing statement along with category id
			$category = $cat->fetch(); //returning a single row from a result set as an array or object

			//printing datas from the database
			echo '<h2>' . $category['name'] . ':</h2>';
			echo '<h1>' . $article['title'] . '</h1>';

			//getting image from the folder which have in stored
			if (file_exists('../images/article/' . $article['id'] . '.jpg')) { //see if there is an existing file or not 
				//helps to get image from the folder where image was inserted 
				echo '<center><a href="../images/article/' . $article['id'] . '.jpg"><img src="../images/article/' . $article['id'] . '.jpg" style="width:50%; height:50%;"/></a></center>';
			}
			echo '<div class="details">';
            echo '<h3>' . $article['content'] . '</h3>';			
            echo '<em style="float:right;">' . $article['publishDate'] . '</em> <br>';
			echo '<em style="float:right; "> Posted By:' . $article['adminId'] . '</em>';
            echo '</div>';
            echo '<a href="editArticle.php?id=' . $article['id'] . '">Edit</a>'; // sending article id through edit link to edit
            echo '<form method="post" action="deleteArticle.php">
                    <input type="hidden" name="id" value="' . $article['id'] . '" /> <!-- sending article id through button to delete -->
                    <input type="submit" name="delete" value="Delete" style="margin-top:-100px; width:100px; margin-left:35px;" />
                    </form>';
				}
				?>
				</main>
				<footer>
					&copy; Northampton News 2017
				</footer>
</body>
</html>
