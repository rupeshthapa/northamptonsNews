<?php
//using the database parameters
include('database_connection.php');
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
			<li><a href="index.php">Home</a></li>
			<li><a href="#">Select Category</a>
			<ul>
				<?php
				
				$fetch = "SELECT * FROM category"; // query to get datas from database table 
				$fetch1 = $database->prepare($fetch); // preparing query
				$fetch1->execute(); // executing prepared query
				$fetch1->setfetchMode(PDO::FETCH_OBJ); // setting the default fetching mode for the statement
				$result = $fetch1->fetchALL(); // fetches the remaining rows from the result set 
				if($result){ // if fetched 
					foreach($result as $results){ // traversing the array elements
					?>
					<br>
					<center>
						<!--provides the id of the datas and send through the edit link to get datas according to the id-->
						<li><a href="users_cat.php?id=<?=$results->id;?>"><?=$results->name;?></a></li>;
					</center>
					<?php
					}
				}
				?>
				</ul>
			</li>
			<li><a href="login.php">LogIn</a></li>
			<li><a href="register.php">Register Here</a></li>
		</ul>
	</nav>
	<img src="images/banners/randombanner.php" /> 
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
		if (file_exists('images/article/' . $article['id'] . '.jpg')) { //checks if there is an existing file or not 
			// if there is an existing file it will give image according to id 
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
