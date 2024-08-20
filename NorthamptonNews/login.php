<?php
ob_start(); //turning on output buffer
session_start();
include('database_connection.php');//connecting database as well local server

// for logging in through the records added into the database
if(isset($_POST['login'])){ //determining if a variable is declared and is different than null 
	// selecting the records from the database and preparing the sql statement at the same time  
	$stmt = $database->prepare("SELECT * FROM users WHERE name = ?");
	$stmt2 = $database->prepare("SELECT * FROM admin WHERE name = ?");
	
	// database executing the query
	$stmt->execute([$_POST['name']]);
	$user = $stmt->fetch();

	$stmt2->execute([$_POST['name']]);
	$admin = $stmt2->fetch();
	
	// after verifying password of presented in the database 
	if ($user && password_verify($_POST['password'], $user['password'])){ //verfiy the given password matches with hash password or not
		$_SESSION['name'] = $_POST['name']; // starting the global variable 
		$_SESSION['loggedin'] = true;
		header('Location:index2.php');
	}
	elseif ($admin && password_verify($_POST['password'], $admin['password'])){
		$_SESSION['name'] = $_POST['name'];
		$_SESSION['loggedin'] = true;
		header('Location:admin/adminArticle.php');
	}
	else{
		echo'invalid';
	}
}
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
				<li><a href="index.php">Home</a></li>
				<li><a href="#">Select Category</a>
				<ul>
					<?php
					$fetch = "SELECT * FROM category"; // getting datas from database table using sql query 
					$fetch1 = $database->prepare($fetch); // preparing sql statement
					$fetch1->execute(); // prepared query getting executed 
					$fetch1->setfetchMode(PDO::FETCH_OBJ); // setting the default fetching mode
					$result = $fetch1->fetchALL(); // fetching remaining rows from the result
					if($result){ // if fetched 
						foreach($result as $row){ // using loop to for tranversing the array elements
						?>
						<br>
						<center>
							<!--sending id of the datas stored in the database-->
							<li><a href="users_cat.php?id=<?=$row->id;?>"><?=$row->name;?></a></li>;
						</center>
						<?php
						}
					}
					?>
					</ul>
				</li>
			</ul>
		</nav>
		<main>
			<nav>

			</nav>
			<h2>Log in</h2>
			<form action="login.php" method="post" style="padding: 40px">
			<label>Enter name:</label>
			<input type="text" name="name" />
			<label>Enter Password</label>
			<input type="password" name="password" /><br>
			<input type="submit" name="login" value="Log In" />
		</form>
	</main>
	<footer>
		&copy; Northampton News 2017
	</footer>
</body>
</html>
