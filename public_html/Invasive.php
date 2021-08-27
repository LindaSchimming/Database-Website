
<?php
	session_start();

	$link=mysqli_connect("localhost", "ls117542", "", "ls117542")
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
		<title> Invasive species </title> 
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
				<li><a href="http://webdev.cs.umt.edu/~ls117542/searchState.php"> Search By State </a></li>
				<li><a href="http://webdev.cs.umt.edu/~ls117542/searchToxin.php"> Search By Toxin Danger </a></li>
				<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/Invasive.php"> View Invasive Species </a></li>
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
					<li><a href="http://webdev.cs.umt.edu/~ls117542/searchState.php"> Search By State </a></li>
					<li><a href="http://webdev.cs.umt.edu/~ls117542/searchToxin.php"> Search By Toxin Danger </a></li>
					<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/Invasive.php"> View Invasive Species </a></li>
					<li><a href="http://webdev.cs.umt.edu/~ls117542/schema.php"> Database Schemas</a></li>
					<li >
						<form method='post' action="">
						<input style="background-color:firebrick; color: white;" type="submit" value="Logout" name="logout">
						</form>
					</li>	
				</ul>
			<?php } ?>

			<div class= "pageContent">
				<h1> Invasive Species </h1>
			</div>

	</body>

</html>

<?php
echo '<div class= "pageContent">';
//http://webdev.cs.umt.edu/~ls117542/
  // create short variable names

  // connect to database

  $link=mysqli_connect("localhost", "ls117542", "", "ls117542")
     or die('Could not connect ');


  $query = "  SELECT photo,abbreviation, genus, species, threatlvl, startYear, threatDesc from Animal,Invasive,States,Description
 where AnimalID IN (Select AnimalID from Animal,Habitat,Invasive where AnimalID = HAnimalID and
 HAnimalID IN (Select HAnimalID from Habitat,Inside,Invasive where habitatID = INHabitatID and
 INInvasionID IN (Select invasionID from Invasive)))
 and AnimalID = IAnimalID and DAnimalID = AnimalID
and (stateID, invasionID) IN  (Select stateID,invasionID from States,Inside,Invasive where stateID = INstateID and
 invasionID = INInvasionID)
 order by abbreviation";

  $result = mysqli_query($link,$query) 
	  or die("Query failed ");


  
  $num_results = mysqli_num_rows($result);


 while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {   

	 $photo = $row["photo"];
	 $state = $row["abbreviation"];
	 $genus = $row["genus"];
	 $species = $row["species"];
	 $threat = $row["threatlvl"];
	 $startYear = $row["startYear"];
	 $threatDesc = $row["threatDesc"];

	echo "<table>\n";
	echo "<tr>\n";
	echo "<th><b>State</b></th>\n";
	echo "<th><b>Genus</b></th>\n";
	echo "<th><b>Species<b></th>\n";
	echo "<th><b>Start Year<b></th>\n";
	echo "<th><b>Threat Level<b></th>\n";
	echo "<th><b>Threat Description<b></th>\n";
	echo "<th><b>Image</b></th>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td> $state </td>\n";
	echo "<td> $genus </td>\n";
	echo "<td> $species </td>\n";
	echo "<td> $startYear </td>\n";
	echo "<td> $threat </td>\n";
	echo "<td> $threatDesc </td>\n";
	echo "<td><img style = 'display:block;' width='200px' height='auto' src='$photo'></td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	
	

}

echo '</div>';

//Free result set
mysqli_free_result($result);

//close connection
mysqli_close($link);
?>
