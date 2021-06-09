<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> CreateList </title>
		<meta charset = "UTF-8">
		<link rel = "stylesheet" href = "style.css">
	</head>
	<body>
		<ul> 
			<li><a href="http://webdev.cs.umt.edu/~ls117542/"> Welcome!</a></li>
            <li><a href="http://webdev.cs.umt.edu/~ls117542/Home.php"> Home </a></li>
			<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/CreateTable.php"> Create a List</a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/ViewTables.php"> View Lists </a></li>
            <li><a href="http://webdev.cs.umt.edu/~ls117542/addTable.php"> Add to Lists </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/search.php"> Search By Name </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/searchState.php"> Search By State </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/searchToxin.php"> Search By Toxin Danger </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/Invasive.php"> View Invasive Species </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/schema.php"> Database Schemas</a></li>
			<li >
                <form method='post' action="">
                <input style="background-color:firebrick; color: white;" type="submit" value="Logout" name="logout">
                </form>
            </li>	
		</ul>
        <div class= "pageContent">
            <h1>Create List</h1>
            <span style="font-size:18px" >
            <form action="CreateTable.php" method="post">
            List Name: <br />
            <input name="tableName" type="text" required>
            <br />
            List Description: <br />
            <input name="listText" type="text">
            <br />
            <input type="submit" value="Create">
            </form>
            </span>

      </div>
	</body>

</html>

<?php
echo '<div class = "pageContent"> ';
    session_start();
   
   $user_check = $_SESSION['login_user'];
 
   if(!isset($_SESSION['login_user'])){
     header('Location: index.php');
     die();
   }

   if(isset($_POST['logout'])){
    session_destroy();
    header('Location: index.php');
    }
  $link=mysqli_connect("localhost", "ls117542", "oo0dij0eezu9aiL3hiR6ahth6aeJaf", "ls117542")
     or die('Could not connect ');



  // create short variable names

    $userid = $_SESSION['userid'];

  $tableName=$_POST["tableName"];
  $tableName= trim($tableName);


  $listText=$_POST["listText"];
  $listText= trim($listText);

  
  if (!$tableName)
  {
     exit;
  }


  

  // insert new data into table
  $query = "INSERT INTO List (listName,userID, listText) values ('$tableName','$userid','$listText')";
  $result = mysqli_query($link,$query)		 
	  or die("Failed to create list");
echo '<script>alert("List created")</script>';

echo'</div>';
//Free result set
mysqli_free_result($result);

//close connection
mysqli_close($link);

?>

