<?php
ob_start();// turning on output buffer
include('../database_connection.php'); // including the file which connects into localhost and into database 
?>
<?php
//FOR EDITING ARTICLES
if(isset($_POST['edit'])){ //helps to edit article after clicking edit 
	$id = $_POST['id']; //gets article id
	$title = $_POST['title']; //getting article title
	$categoryId = $_POST['categoryId']; //getting article category
	$content = $_POST['content']; // getting content
	
	//throwing exception
	try{ 
		  
	  $editing_query ="UPDATE articles SET title=:title, categoryId=:categoryId, content=:content WHERE id=:id"; //set new records removing previous one 
	  
	  $statement =$database->prepare($editing_query); //preparing query
	  
	  //checking database name and field names
	  $data = [
		  'title' => $title, 
		  'categoryId' => $categoryId, 
		  'content' => $content,
		  'id' => $id  
		];
		
		$query_execute = $statement->execute($data); //executing the new values
		
		//image inserting query
		if ($_FILES['image']['error'] == 0) { 
		  $fileName = $database->lastInsertId() . '.jpg'; //gets last inserted image id and prints in .jpg form
		  move_uploaded_file($_FILES['image']['tmp_name'], '../images/article/' . $fileName); //upload a image from the directory 
		}
	  
		if($query_execute){ //if sql statement is executed 
		  echo "Edited Successfully"; // shows message editted successfully
		  header('Location:adminArticle.php'); // and takes it to admin home page
		  exit(0);
		}
		else{
		 echo "Not Updated Successfully"; // else displays not updated successfully
		  header('Location:editArticle.php'); // and stays on the same page
		  exit(0);
		}
	  }
	   catch(PDOException $e){ // catching the exception 
		  echo $e->getMessage(); // and gets error messages
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
				// editing article
				if(isset($_GET['id'])){ // getting id sent from the edit link 
					$article_id = $_GET['id'];
					$query = "SELECT * FROM articles WHERE id=:id"; // query for selecting records from the database
					$statement = $database->prepare($query); // executing the sql statement
					$data = [':id' => $article_id]; // checking the database id and sent id
					$statement->execute($data); // query execution
					$data = $statement->fetch(PDO::FETCH_ASSOC); // fetching with asscociation method
					?>
					<h2>Edit Article</h2>
					<form action ='editArticle.php' method ='POST' enctype="multipart/form-data">
						<input type="hidden" name="id"  value="<?=$data['id']?>"/> <!-- prints id of the article but will be invisible because of hidden-->
						<label>Title</label> 
						<input type="text" name="title" value="<?=$data['title']?>"/> <!--prints the previous title-->
						<label>Category</label>
						<select name="categoryId">
							<?php
							//fetching categories 
							$category = $database->prepare('SELECT * FROM category');
							$category->execute();
							foreach ($category as $categories) {
								echo '<option value="' . $categories['id'] . '">' . $categories['name'] . '</option>';
							}
							?>
							</select>
							<label>Article</label> 
							<textarea type="text" name="content" value="<?=$data['content']?>"></textarea> <!-- article wont get printed because its datatype is longtext-->
							<label>Image</label>
							<input type="file" name="image" />
							<input type="submit" name="edit" value="Edit Article" />
						</form>
						<?php
						} 
						?>
						</article>
					</main>
					<footer>
						&copy; Northampton News 2017
					</footer>
	</body>
</html>
