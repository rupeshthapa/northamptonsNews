<?php
session_start();//resuming the session
include('database_connection.php'); //using the database parameters

?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>
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
				<li><a href="index2.php">Home</a></li>
				<li><a href="#">Select Category</a>
				<ul>
					<?php
					$fetch = "SELECT * FROM category"; // selecting datas from database table using query 
					$fetch1 = $database->prepare($fetch); // preparing query
					$fetch1->execute(); // executes prepared query
					$fetch1->setfetchMode(PDO::FETCH_OBJ); // fetching with object method 
					$result = $fetch1->fetchALL(); // fetching remaining rows  
					if($result){ // if fetched 
						foreach($result as $results){ // looping the array elements
						?>
						<br>
						<center>
							<!--sends id of the inserted datas-->
							<li><a href="users_cat.php?id=<?=$results->id;?>"><?=$results->name;?></a></li>;
						</center>
						<?php
						}
					}
					?>
					</ul>
				</li>
				<li><a href="logout.php">Log Out</a></li>
			</ul>
		</nav>
		<img src="images/banners/randombanner.php" />
		<?php
			if (isset($_SESSION['name'])){ // after loggedin gets the name who has logged in using global variable
				$user = $_SESSION['name'];
				echo '<center><h2>Welcome'. ' ' . $user . '</h1></center>';
			}
		
		?>
		<?php
		//getting the articles from the database
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
			if (file_exists('images/article/' . $article['id'] . '.jpg')) { //checks if there is an existing file or not
				//if there is it gives images according to id
				echo '<center><a href="images/article/' . $article['id'] . '.jpg"><img src="images/article/' . $article['id'] . '.jpg" style="width:50%; height:50%;"/></a></center>';
			}
			echo '<div class="details">';
			echo '<h3>' . $article['content'] . '</h3>';			
			echo '<em style="float:right;">' . $article['publishDate'] . '</em> <br>';
			echo '<em style="float:right; "> Posted By:' . $article['adminId'] . '</em>';
			echo '</div>';
		}
	
	?>
	<footer>
		&copy; Northampton News 2017
	</footer>
</body>
</html>
