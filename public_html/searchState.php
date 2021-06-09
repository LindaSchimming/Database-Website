
<?php
	session_start();

	$link=mysqli_connect("localhost", "ls117542", "oo0dij0eezu9aiL3hiR6ahth6aeJaf", "ls117542")
	or die('Could not connect ');


	$user_check = $_SESSION['login_user'];


	if(isset($_POST['logout'])){
	session_destroy();
	header('Location: index.php');
	}

?>

<!DOCTYPE html>
<html lang = "en">
	<head>
		<title> >Reptile Search by State </title>
		<meta charset = "UTF-8">
		<link rel = "stylesheet" href = "style.css">
	</head>
	<style>
		table, th, td {
		  border: 1px solid black;
		  border-collapse: collapse;

		}
	</style>
	<body>
		<?php if(!isset($_SESSION['login_user'])){ ?>
			<ul>
				<li><a href="http://webdev.cs.umt.edu/~ls117542/"> Welcome!</a></li>
				<li><a href="http://webdev.cs.umt.edu/~ls117542/Login.php"> Login</a></li>
				<li><a href="http://webdev.cs.umt.edu/~ls117542/CreateAccount.php">Create Account</a></li>
				<li><a href="http://webdev.cs.umt.edu/~ls117542/search.php"> Search By Name </a></li>
				<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/searchState.php"> Search By State </a></li>
				<li><a href="http://webdev.cs.umt.edu/~ls117542/searchToxin.php"> Search By Toxin Danger </a></li>
				<li><a href="http://webdev.cs.umt.edu/~ls117542/Invasive.php"> View Invasive Species </a></li>
				<li><a href="http://webdev.cs.umt.edu/~ls117542/schema.php"> Database Schemas</a></li>

			</ul>
			<?php } ?>
			<?php if(isset($_SESSION['login_user'])){ ?>
				<ul> 
					<li><a href="http://webdev.cs.umt.edu/~ls117542/"> Welcome!</a></li>
					<li><a href="http://webdev.cs.umt.edu/~ls117542/Home.php"> Home </a></li>
					<li><a href="http://webdev.cs.umt.edu/~ls117542/CreateTable.php"> Create a List</a></li>
					<li><a href="http://webdev.cs.umt.edu/~ls117542/ViewTables.php"> View Lists </a></li>
					<li><a href="http://webdev.cs.umt.edu/~ls117542/addTable.php"> Add to Lists </a></li>
					<li><a href="http://webdev.cs.umt.edu/~ls117542/search.php"> Search By Name </a></li>
					<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/searchState.php"> Search By State </a></li>
					<li><a href="http://webdev.cs.umt.edu/~ls117542/searchToxin.php"> Search By Toxin Danger </a></li>
					<li><a href="http://webdev.cs.umt.edu/~ls117542/Invasive.php"> View Invasive Species </a></li>
					<li><a href="http://webdev.cs.umt.edu/~ls117542/schema.php"> Database Schemas</a></li>
					<li >
						<form method='post' action="">
						<input style="background-color:firebrick; color: white;" type="submit" value="Logout" name="logout">
						</form>
					</li>	
				</ul>
			<?php } ?>
		
		<div class = "pageContent">
			<h1>Reptile State Search</h1>
			<span style="font-size:18px" ><p>Note: Not every reptile is in the database</p>

			<form action="searchState.php" method="post">
    
			Enter State Abbreviation(Postal Code): ex: MT<br />
			<input name="state" type="text" maxlength = "2" required>
			<p></p>
			<input type="submit" value="Search">
			</form>
			<p></p>
			</span>
		</div>
	</body>

</html>

<?php
echo '<div class= "pageContent">';
//http://webdev.cs.umt.edu/~ls117542/
  // create short variable names
  $state=$_POST["state"];
  $state= strtoupper(trim($state));


  if (!$state)
  {
     exit;
  }
  

  // connect to database
  $link=mysqli_connect("localhost", "ls117542", "oo0dij0eezu9aiL3hiR6ahth6aeJaf", "ls117542")
     or die('Could not connect ');


  $query = " SELECT photo,genus,species,animalType,commonName,toxinType,severity,symptoms from Animal
 Inner Join CommonName ON AnimalID=CNAnimalID
 Left Join Toxins ON AnimalID = TAnimalID
 Left Join Description ON AnimalID = DAnimalID
 where AnimalID IN (Select AnimalID from Animal,Habitat where AnimalID = HAnimalID and
 HAnimalID IN (Select HAnimalID from Habitat,Inside where habitatID = INHabitatID and
 INStateID IN (Select stateID from States where abbreviation = '$state')))";

  $result = mysqli_query($link,$query) 
	  or die("Query failed ");


  
  $num_results = mysqli_num_rows($result);

 

 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {   

	 $photo = $row["photo"];
	 $genus = $row["genus"];
	 $species = $row["species"];
	 $animalType = $row["animalType"];
	 $commonName = $row["commonName"];
	 $toxinType = $row["toxinType"];
	 $severity = $row["severity"];
	 $symptoms = $row["symptoms"];

	echo "<table>\n";
	echo "<tr>\n";
	echo "<th><b>Image</b></th>\n";
	echo "<th><b>Genus</b></th>\n";
	echo "<th><b>Species<b></th>\n";
	echo "<th><b>Animal Type<b></th>\n";
	echo "<th><b>Common Name<b></th>\n";
	echo "<th><b>Toxin<b></th>\n";
	echo "<th><b>Severity level</b></th>\n";
	echo "<th><b>Symptoms</b></th>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td><img style = 'display:block;' width='200px' height='auto' src='$photo'></td>\n";
	echo "<td> $genus </td>\n";
	echo "<td> $species </td>\n";
	echo "<td> $animalType </td>\n";
	echo "<td> $commonName </td>\n";
	echo "<td> $toxinType </td>\n";
	echo "<td> $severity </td>\n";
	echo "<td> $symptoms </td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	
	

}
echo '</div>';


//Free result set
mysqli_free_result($result);

//close connection
mysqli_close($link);
?>
