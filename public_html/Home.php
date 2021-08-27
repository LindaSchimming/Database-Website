<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> Home </title>
		<meta charset = "UTF-8">
		<link rel = "stylesheet" href = "style.css">
	</head>
	<body>
		<ul> 
			<li><a href="http://webdev.cs.umt.edu/~ls117542/"> Welcome!</a></li>
            <li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/Home.php"> Home </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/CreateTable.php"> Create a List</a></li>
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

		<div class = "pageContent">  
          <h1>You have logged in <?php echo $login_session; ?></h1> 
          <h3> You can now create, view, and add to lists.</h3>
          <img width='70%' height='auto' src='.\Media\homePic.jpg'>
          <br />
          <br />
          <br />
          <form method='post' action="">
          <h3> WARNING THIS WILL DELETE YOUR ACCOUNT AND ALL SAVED LISTS </h3>
            <input type="submit" value="Reset" name="reset">
          </form>
      </div>
	</body>

</html>


<?php
echo '<div class = "pageContent"> ';
    session_start();

    $link=mysqli_connect("localhost", "ls117542", "", "ls117542")
    or die('Could not connect ');
  
   
   $user_check = $_SESSION['login_user'];
   $userid = $_SESSION['userid'];
 
   if(!isset($_SESSION['login_user'])){
    header('Location: index.php');
     die();
   }

   if(isset($_POST['logout'])){
    session_destroy();
    header('Location: index.php');
    }
    if(isset($_POST['reset'])){
    $query = "SET FOREIGN_KEY_CHECKS = 0";
    $result = mysqli_query($link,$query)		 
	  or die("Failed to Delete LisyAnimals");
     echo "Deleted";

    $query = "TRUNCATE TABLE ListAnimals";
    $result = mysqli_query($link,$query)		 
	  or die("Failed to Delete LisyAnimals");
     echo "Deleted";
    $query = "TRUNCATE TABLE List";
    $result = mysqli_query($link,$query)		 
	  or die("Failed to delete List");
     echo "Deleted";
    $query = "TRUNCATE TABLE Users";
    $result = mysqli_query($link,$query)		 
	  or die("Failed to delete Users");
     echo "Deleted";

    $query = "SET FOREIGN_KEY_CHECKS = 1";
    $result = mysqli_query($link,$query)		 
	  or die("Failed to Delete LisyAnimals");
     echo "Deleted";
    
    session_destroy();
    header('Location: index.php');
    }
   
    echo '</div>';
?>
