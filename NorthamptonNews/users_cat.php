<?php
session_start(); //resuming the session
include('database_connection.php'); //using the database parameters
?>
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css" type="text/css"/>
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
			<?php
			//getting the global variable through the session 
			if(isset($_SESSION['name'])){
				?>
				<li><a href="index2.php">Home</a></li>
				<?php
				}
				else{
					?>
					<li><a href="index.php">Home</a></li>
					<?php
					}
					?>
					<li><a href="#">Select Category</a>
					<ul>
						<?php
						$fetch = "SELECT * FROM category"; // getting datas from database table query 
						$fetch1 = $database->prepare($fetch); // preparing query
						$fetch1->execute(); // executing query
						$fetch1->setfetchMode(PDO::FETCH_OBJ); // fetching with object method 
						$result = $fetch1->fetchALL(); // fetching all 
						if($result){ // if fetched 
							foreach($result as $results){ // displaying datas
							?>
							<br>
							<center>
								<!--sedning ids and it helps to print the news according to the category id-->
								<li><a href="users_cat.php?id=<?=$results->id;?>"><?=$results->name;?></a></li>;
							</center>
							<?php
							}
						}
						?>
						</ul>
						
					</li>
				</ul>
			</nav>
			<?php
			
		//fetching articles according to the category
		$id = $_GET['id']; //getting id sent from category
		$sql_query = $database->prepare('SELECT * FROM articles WHERE categoryId = '.$id); // selecting records according to the category id
		$sql_query->execute();
		foreach($sql_query as $article){
		//printing datas from the database
		
		echo '<h1>' . $article['title'] . '</h1>';

		//getting image from the folder which have in stored
		if (file_exists('images/article/' . $article['id'] . '.jpg')) { //see if there is existing file or not 
			// and gets the image from the folder
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
