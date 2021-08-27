
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
		<title> Reptile Search </title>
		<meta charset = "UTF-8">
		<link rel = "stylesheet" href = "style.css">
	</head>
	<style>
	table, th, td {
		  border: 1px solid black;
		  border-collapse: collapse;

		}

	td{
		font-size: 20px;
		text-align: center;
	}
	th{
		font-size: 20px;
		text-align: center;
	}
	</style>
	<body>
		<?php if(!isset($_SESSION['login_user'])){ ?>
			<ul>
				<li><a href="http://webdev.cs.umt.edu/~ls117542/"> Welcome!</a></li>
				<li><a href="http://webdev.cs.umt.edu/~ls117542/Login.php"> Login</a></li>
				<li><a href="http://webdev.cs.umt.edu/~ls117542/CreateAccount.php">Create Account</a></li>
				<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/search.php"> Search By Name </a></li>
				<li><a href="http://webdev.cs.umt.edu/~ls117542/searchState.php"> Search By State </a></li>
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
					<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/search.php"> Search By Name </a></li>
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
			<?php } ?>

		<div class = "pageContent">
			<h1>Reptile Search</h1>

			<span style="font-size:18px" >
			<form action="search.php" method="post">
    
			Enter Scientific name:<br />
			Genus: ex: Thamnophis <br />
			<input name="genus" type="text" required>
			<br />
			Species: ex: sirtalis<br />
			<input name="species" type="text" required>
			<br />
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
  $genus=$_POST["genus"];
  $genus= trim($genus);

  $species=$_POST["species"];
  $species= trim($species);



  if (!$genus && !$species)
  {
     exit;
  }
  

  // connect to database
  $link=mysqli_connect("localhost", "ls117542", "", "ls117542")
     or die('Could not connect ');


  $query = "SELECT genus,species,animaltype,commonName,photo, animalLength, endangered, appearance,handleability,activeTimeYR,maturityAge,diet,activeTimeDay,huntingStyle,avgEggNum,biome,climate,lotemp,hitemp,toxinType,symptoms from Animal
 Inner Join CommonName ON AnimalID=CNAnimalID
 Inner Join Description ON AnimalID=DAnimalID
 Inner Join LifeStyle On AnimalID = LifeID
 Inner Join Habitat On AnimalID=HAnimalID
 Left Join Toxins On AnimalID=TAnimalID
 where AnimalID IN (Select AnimalID from Animal where genus like '%".$genus."%' and species like '%".$species."%')";

  $result = mysqli_query($link,$query) 
	  or die("Query failed ");


  
  $num_results = mysqli_num_rows($result);

  

 $previousList = null;
 $num = 0;

  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {   

	 $photo = $row["photo"];
	 $genus = $row["genus"];
	 $species = $row["species"];
	 $common = $row["commonName"];
	 $appearance = $row["appearance"];
	 $length = $row["animalLength"];
	 $handle = $row["handleability"];

	 $timeYR = $row["activeTimeYR"];
	 $timeDay = $row["activeTimeDay"];
	 $diet = $row["diet"];
	 $hunting = $row["huntingStyle"];
	 $maturityAge = $row["maturityAge"];
	 $egg = $row["avgEggNum"];

	 $biome = $row["biome"];
	 $climate = $row["climate"];
	 $lo = $row["lotemp"];
	 $hi = $row["hitemp"];

	 $toxin = $row["toxinType"];
	 $symptoms = $row["symptoms"];



	echo "<table>\n";
	echo "<tr>\n";
	echo "<th><b>Image</b></th>\n";
	echo "<th><b>Genus</b></th>\n";
	echo "<th><b>Species<b></th>\n";
	echo "<th><b>Common Name<b></th>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td><img style = 'display:block;' width='200px' height='auto' src='$photo'></td>\n";
	echo "<td> $genus </td>\n";
	echo "<td> $species </td>\n";
	echo "<td> $common </td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	
	echo "<table>\n";
	echo "<th><b>Appearance<b></th>\n";
	echo "<th><b>Length(in.)<b></th>\n";
	echo "<th><b>Handleability<b></th>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td> $appearance</td>\n";
	echo "<td> $length </td>\n";
	echo "<td> $handle </td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	
	echo "<table>\n";
	echo "<th><b>Active time of Year<b></th>\n";
	echo "<th><b>Active time of Day<b></th>\n";
	echo "<th><b>Diet<b></th>\n";
	echo "<th><b>Hunting Style<b></th>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td> $timeYR </td>\n";
	echo "<td> $timeDay </td>\n";
	echo "<td> $diet </td>\n";
	echo "<td> $hunting</td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	
	echo "<table>\n";
	echo "<th><b>Sexual Maturity(months)<b></th>\n";
	echo "<th><b>Avg Offspring<b></th>\n";
	echo "<th><b>Biome<b></th>\n";
	echo "<th><b>Climate<b></th>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td> $maturityAge </td>\n";
	echo "<td> $egg </td>\n";
	echo "<td> $biome </td>\n";
	echo "<td> $climate </td>\n";
	echo "</tr>\n";
	echo "</table>\n";
	
	echo "<table>\n";
	echo "<th><b>Type of Toxin<b></th>\n";
	echo "<th><b>Symptoms<b></th>\n";
	echo "</tr>\n";
	echo "<tr>\n";
	echo "<td> $toxin </td>\n";
	echo "<td> $symptoms</td>\n";
	echo "</tr>\n";
	echo "</table>\n";










}
echo '</div>';


//Free result set
mysqli_free_result($result);

//close connection
mysqli_close($link);
?>


