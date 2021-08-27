
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
		<title>Search by Toxin Danger level </title>
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
				<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/searchToxin.php"> Search By Toxin Danger </a></li>
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
					<li><a href="http://webdev.cs.umt.edu/~ls117542/searchState.php"> Search By State </a></li>
					<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/searchToxin.php"> Search By Toxin Danger </a></li>
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
		  <h1>Toxin Danger Level search</h1>
		  <span style="font-size:18px" >
		  <form action="searchToxin.php" method="post">
    
			Enter level to search from 1 to 5 (ex:3) will grab search level and anything more dangerous:<br />
			<input name="level" type="number" min ="1" max ="5" required>
			<br />
			<input type="submit" value="Search" >
		  </form>
		  <br />
		  </span>
		</div>

		
	</body>

</html>


<?php
echo '<div class= "pageContent">';
//http://webdev.cs.umt.edu/~ls117542/
  // create short variable names
  $level=$_POST["level"];
  $level= trim($level);

  
  if (!$level)
  {
     exit;
  }




  // connect to database
  $link=mysqli_connect("localhost", "ls117542", "", "ls117542")
     or die('Could not connect ');


  $query = "Select severity, symptoms,photo, genus, species, commonName From Animal
Inner join CommonName ON AnimalID=CNAnimalID
Inner join Toxins ON AnimalID=TAnimalID
Left join Description ON AnimalID = DAnimalID
where severity >= $level";

  $result = mysqli_query($link,$query) 
	  or die("Query failed ");


  
  $num_results = mysqli_num_rows($result);


  if ($num_results == 0)
  {
        echo 'There are no animals of this toxin level or more than this level. Search again';
  }

  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {   

	 $photo = $row["photo"];
	 $genus = $row["genus"];
	 $species = $row["species"];
	 $commonName = $row["commonName"];
	 $severity = $row["severity"];
	 $symptoms = $row["symptoms"];

	echo "<table>\n";
	echo "<tr>\n";
	echo "<th><b>Severity level</b></th>\n";
	echo "<th><b>Genus</b></th>\n";
	echo "<th><b>Species<b></th>\n";
	echo "<th><b>Common Name<b></th>\n";
	echo "<th><b>Symptoms</b></th>\n";
	echo "<th><b>Image</b></th>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td> $severity </td>\n";
	echo "<td> $genus </td>\n";
	echo "<td> $species </td>\n";
	echo "<td> $commonName </td>\n";
	echo "<td> $symptoms </td>\n";
	echo "<td><img style = 'display:block;' width='200px' height='auto' src='$photo'></td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	
	

}

echo'</div>';


//Free result set
mysqli_free_result($result);

//close connection
mysqli_close($link);
?>
