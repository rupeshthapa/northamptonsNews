<?php
ob_start(); // turning on output buffer 

// Giving refrence of ob_start code in a harvard style: 
// Chris Gutierrez, (2013). Solving the header issues. 
// Stackoverflow: Chris Gutierrez.

session_start(); // resuming session
include('database_connection.php');//using the database parameters

//for registering users 

if(isset($_POST['register'])){ // checking value is set or not on the button click
	$name = $_POST['name']; //getting name entered by the user
	$email = $_POST['email']; //getting email entered by the user
	$password = $_POST['password']; //getting password field entered by the user
	$hash = password_hash($password, PASSWORD_DEFAULT); // hashing the password
  
	$user_insert_query ="INSERT INTO users (name, email, password)VALUES(:name,:email,:password)"; //inserting query which helps to put entered datas into database
	
	$statement =$database->prepare($user_insert_query); //preparing sql query
	
	//checking database names and fields name
	$check = [
	':name' => $name,
	':email' => $email,
	':password' => $hash
   ];
  
	$statement->execute($check); //executing the details
	if($statement){
	header('Location:login.php'); //takes into login page after submitting the details
	}  
  } 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
					$fetch = "SELECT * FROM category"; // query to select datas from database table  
					$fetch1 = $database->prepare($fetch); // preparing the query
					$fetch1->execute(); // executing prepared query
					$fetch1->setfetchMode(PDO::FETCH_OBJ); // fetching with object method 
					$result = $fetch1->fetchALL(); // fetching the remaing rows
					if($result){ // if fetched 
						foreach($result as $row){ // displaying datas
						?>
						<br>
						<center>
							<!--returns id and send it through the link-->
							<li><a href="users_cat.php?id=<?=$row->id;?>"><?=$row->name;?></a></li>;
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
		<main>
			<nav>

			</nav>
			<h2>Registration Form</h2>
			<form action ='register.php' method='POST'>
				<label>Name:</label>
                <input type ="text" name="name" placeholder="Enter your fullname" required><br>
                <label>Email:</label>
                <input type ="email" name="email" placeholder="Enter your email." required><br>
                <label>Password:</label>
                <input type="password" name="password" placeholder="Enter your password." required><br><br>
                <button type="submit" name="register" value="submit" class="button">Register</button>
			</form>
		</article>
	</main>
	<footer>
		&copy; Northampton News 2017
	</footer>
</body>
</html>