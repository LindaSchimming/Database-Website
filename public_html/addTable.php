<?php
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

  $link=mysqli_connect("localhost", "ls117542", "", "ls117542")
     or die('Could not connect ');

  $userid = $_SESSION['userid'];
  $query = "Select ListID,listName From List where userID = $userid";
  $result = mysqli_query($link, $query)  
		or die("Query failed ");
  $num_results = mysqli_num_rows($result);
  $_SESSION['numList'] = $num_results;
	
?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> Add to Lists </title>
		<meta charset = "UTF-8">
		<link rel = "stylesheet" href = "style.css">
	</head>
	<style>

	</style>
	<body>
		<ul> 
			<li><a href="http://webdev.cs.umt.edu/~ls117542/"> Welcome!</a></li>
            <li><a href="http://webdev.cs.umt.edu/~ls117542/Home.php"> Home </a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/CreateTable.php"> Create a List</a></li>
			<li><a href="http://webdev.cs.umt.edu/~ls117542/ViewTables.php"> View Lists </a></li>
			<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/addTable.php"> Add to Lists </a></li>
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
		 <h1>Add to Lists</h1>
		 <?php
		 $num = $_SESSION['numList'];
		 
		 if($num != 0){ 
		 ?>
			
			 <form action="addTable.php" method="post">
				<h3>Choose a List:</h3>
				<select name="listchoose" required>
				<?php
					 $link=mysqli_connect("localhost", "ls117542", "", "ls117542")
						 or die('Could not connect ');
					$userid = $_SESSION['userid'];
					$query = "Select ListID,listName From List where userID = $userid";
					$result = mysqli_query($link, $query)  
						or die("Query failed ");
					$num_results = mysqli_num_rows($result);
					
					while ($row = mysqli_fetch_array($result , MYSQLI_ASSOC)) {
						$id = $row["ListID"];
						$name = $row["listName"];
	 					echo "<option value='$id'>$name</option>";
					}
				?>
				</select>
					<br />
					<br />
					<h3>Animal to add:</h3>
					<span style="font-size:18px" >
					<p>Enter Scientific name:</p>
					<p>Genus: ex: Thamnophis </p>
					<input name="genus" type="text"  required>
					<br />
					<p>Species: ex: sirtalis</p>
					<input name="species" type="text"  required>
					<br />
					<br />
					<input type="submit" value="Add">
				</form>
				</span>
		<?php } ?>
		<?php
		$num = $_SESSION['numList'];
		if($num == 0){ ?>
			<h3> You do Not have any Lists yet :( </h3>
		<?php } ?>
		</div>

	</body>

</html>



<?php

  $link=mysqli_connect("localhost", "ls117542", "", "ls117542")
     or die('Could not connect ');

  // create short variable names
  $genus=$_POST["genus"];
  $genus= trim($genus);

  $species=$_POST["species"];
  $species= trim($species);

  $AnimalID = null;
 // $values = $_POST['listchoose'];
  $listid = $_POST['listchoose'];

  
    if (!$genus && !$species)
  {
     exit;
  }


   $query = "Select AnimalID from Animal where genus like '%".$genus."%' and species like '%".$species."%'";
   $result = mysqli_query($link, $query)  
	  or die("Query failed ");
  echo "query ok <br>";

   $num_results = mysqli_num_rows($result);


  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {	
	 foreach ($row as $col_value) {	 	
        $AnimalID = $col_value;
	 }	 
  }
  
  // insert new data into table

	  $result = mysqli_query($link,"INSERT INTO ListAnimals (LAListID,LAAnimalID) values ('$listid','$AnimalID')" )		 
		  or die("Failed to add to list");

	  $result = mysqli_query($link,"Select listName from List where ListID = $listid")		 
		  or die("Failed to add to list");

	  $listName = mysqli_fetch_array($result, MYSQLI_ASSOC)['listName'];
	  
echo "<script>alert('Added $genus $species to $listName ')</script>";



//Free result set
mysqli_free_result($result);

//close connection
mysqli_close($link);

?>
