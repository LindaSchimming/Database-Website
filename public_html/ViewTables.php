<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> View Lists </title>
		<meta charset = "UTF-8">
		<link rel = "stylesheet" href = "style.css">
	</head>
	<style>
	.listTitle{
		text-decoration: underline;
	}
	table {
		border-spacing: 10px;
	}
	td{
		font-size: 20px;
		text-align: center;
	}
	th{
		font-size: 20px;
		text-align: center;
	}
	.desc{
		font-size: 18px;
	}
	</style>
	<body>
		<ul> 
			<li><a href="http://webdev.cs.umt.edu/~ls117542/"> Welcome!</a></li>
            <li><a href="http://webdev.cs.umt.edu/~ls117542/Home.php"> Home </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/CreateTable.php"> Create a List</a></li>
			<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/ViewTables.php"> View Lists </a></li>
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
			<h1> My Lists </h1>
		</div>

	</body>

</html>

<?php
//check user login
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

  echo '<div class= "pageContent">';

  $link=mysqli_connect("localhost", "ls117542", "", "ls117542")
     or die('Could not connect ');



  // create short variable names
  $userid = $_SESSION['userid'];


  // insert new data into table
  $query = "Select listName,listText,genus,species,photo From List
  Left Join ListAnimals ON ListID = LAListID
  Left Join Animal ON LAAnimalID = AnimalID
  Left Join Description ON DAnimalID = AnimalID
  where userID = $userid";
  $result = mysqli_query($link, $query)  
	  or die("Query failed ");


   
  $num_results = mysqli_num_rows($result);

  if($num_results == 0){
		echo"<h3>You have not made any lists yet :(</h3>";
  }



  //print column headings
  //echo "\t<tr>\n";
  //while ($fieldinfo = $result -> fetch_field()){
   // echo "\t\t<td>$fieldinfo->name</td>\n";
  //}
  //echo "\t</tr>\n";


 $previousList = null;
 $num = 0;

  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {   

	 $photo = $row["photo"];
	 $list = $row["listName"];
	 $text = $row["listText"];
	 $genus = $row["genus"];
	 $species = $row["species"];
	 if ($list != $previousList){
		if($num != 0){ echo "</table>\n";}
		echo"<h2 class ='listTitle'>$list </h2>\n";
		echo "<p class ='desc'>$text</p>\n";
		echo "<table>\n";
		echo "<tr>\n";
		echo "<th><b>Image</b></th>\n";
		echo "<th><b>Genus</b></th>\n";
		echo "<th><b>Species<b></th>\n";
		echo "</tr>\n";
		echo "<tr>\n";
		echo "<td><img style = 'display:block;' width='200px' height='auto' src='$photo'></td>\n";
		echo "<td> $genus </td>\n";
		echo "<td> $species </td>\n";
		echo "</tr>\n";
	 }
	 else{
		echo "<tr>\n";
		echo "<td><img style = 'display:block;' width='200px' height='auto' src='$photo'></td>\n";
		echo "<td> $genus </td>\n";
		echo "<td> $species </td>\n";
		echo "</tr>\n";
	 }
	 $previousList=$list;
	 $num = 1;
}
echo'</div>';


//Free result set
mysqli_free_result($result);

//close connection
mysqli_close($link);

?>
