<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> CreateAccount </title>
		<meta charset = "UTF-8">
		<link rel = "stylesheet" href = "style.css">
	</head>
	<body>
		<ul>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/"> Welcome!</a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/Login.php"> Login</a></li>
			<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/CreateAccount.php">Create Account</a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/search.php"> Search By Name </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/searchState.php"> Search By State </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/searchToxin.php"> Search By Toxin Danger </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/Invasive.php"> View Invasive Species </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/schema.php"> Database Schemas</a></li>

		</ul>

		<div style = "text-align:center;" class = "pageContent">
          <h1>Create Account</h1>
		  <span style="font-size:18px" >
          <form action="CreateAccount.php" method="post">
    
            Enter Username:<br />
            <input name="username" type="text" required>
            <br />
            Enter Password:<br />
            <input name="password" type="password" required>
            <br />
            <br />
            Re-Enter Password:<br />
            <input name="passCheck" type="password" required>
            <br />
            <input type="submit" value="Create Account">
          </form>
		  </span>
		</div>
	</body>

</html>

<?php
echo '<div style = "text-align:center;" class= "pageContent">';
  // create short variable names
  $username=$_POST["username"];
  $password=$_POST["password"];
  $passCheck = $_POST["passCheck"];
  
  //use trim function to strip whitespace inadvertently entered 
  $username= trim($username);
  $password= trim($password);
  $passCheck = trim($passCheck);

  
    if (!$username && !$password)
  {
     exit;
  }



  if (($password) != ($passCheck))
  {
     echo '<script>alert("Passwords do not match. Try again")</script>';
     exit;
  }
  
  // connect to database
  $link=mysqli_connect("localhost", "ls117542", "oo0dij0eezu9aiL3hiR6ahth6aeJaf", "ls117542")
     or die('Could not connect ');


   $query = "SELECT userID from Users where username = '$username'";
   $result = mysqli_query($link,$query)		 
	  or die("Failed to create account");
	$num_results = mysqli_num_rows($result);
	if($num_results > 0) {
     echo '<script>alert("This username already exists please choose a new username.")</script>';
     exit;
   }

  // insert new data into table
  $result = mysqli_query($link,"INSERT INTO Users (username, password) values ('$username','$password')" )		 
	  or die("Failed to create account");
   echo '<script>alert("Account created")</script>';

echo '</div>';
//Free result set
mysqli_free_result($result);

//close connection
mysqli_close($link);

?>