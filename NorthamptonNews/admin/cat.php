<?php
session_start();//resuming the session
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
							<li><a href="cat.php?id=<?=$category->id;?>"><?=$category->name;?></a></li>; <!-- printing the datas and sending id of the article-->
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
		//fetching articles according to the category
		$id = $_GET['id']; //getting id sent from category
		$sql_query = $database->prepare('SELECT * FROM articles WHERE categoryId = '.$id); // selecting records according to the category id
		$sql_query->execute();
		foreach($sql_query as $article){ //tanversing the array element
		//printing datas from the database
		
		echo '<h1>' . $article['title'] . '</h1>';

		//getting image from the folder which have in stored
		if (file_exists('../images/article/' . $article['id'] . '.jpg')) { //see if there is existing file or not
			//and add the image into that folder
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
				<footer>
					&copy; Northampton News 2017
				</footer>
</body>
</html>
