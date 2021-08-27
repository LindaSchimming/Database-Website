<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> Login </title>
		<meta charset = "UTF-8">
		<link rel = "stylesheet" href = "style.css">
	</head>
	<body>
		<ul>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/"> Welcome!</a></li>
			<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/Login.php"> Login</a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/CreateAccount.php">Create Account</a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/search.php"> Search By Name </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/searchState.php"> Search By State </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/searchToxin.php"> Search By Toxin Danger </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/Invasive.php"> View Invasive Species </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/schema.php"> Database Schemas</a></li>

		</ul>
		
		<div style = "text-align:center;" class = "pageContent">
          <h1>Login</h1>
          <span style="font-size:18px" >
          <form action="Login.php" method="post">
    
            Enter Username:<br />
            <input name="username" type="text" required>
            <br />
            Enter Password:<br />
            <input name="password" type="password" required>
            <br />
            <input type="submit" value="Login">
          </form>
    
          <a href="http://webdev.cs.umt.edu/~ls117542/CreateAccount.php">Don't have an account?</a>
          </span>

		</div>
	</body>

</html>

<?php
echo '<div style = "text-align:center;" class= "pageContent">';
  // create short variable names
  $username=$_POST["username"];
  $password=$_POST["password"];
  $userid = null;
  //use trim function to strip whitespace inadvertently entered 
  $username= trim($username);
  $password= trim($password);

    if (!$username && !$password)
  {
     exit;
  }

  
  // connect to database
  $link=mysqli_connect("localhost", "ls117542", "", "ls117542")
     or die('Could not connect ');
  echo "Connected successfully <br>";

  $query = "SELECT userID from Users where username = '$username' and password = '$password'";
  $result = mysqli_query($link, $query)  
	  or die("Query failed ");
  echo "query ok <br>";

   $num_results = mysqli_num_rows($result);


  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {	
	 foreach ($row as $col_value) {	 	
        $userid = $col_value;
	 }	 
  }


  if($num_results == 1) {
     session_start();
     $_SESSION['login_user'] = $username;
     $_SESSION['userid'] = $userid;
     header("location:Home.php");
   }
  else {
     echo "Login was invalid try again";
     exit;
    }
echo '</div>';
//Free result set
mysqli_free_result($result);

//close connection
mysqli_close($link);

?>
