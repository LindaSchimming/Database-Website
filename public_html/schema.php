
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
<html lang="en"> 
<head>
    <title> Database Schemas </title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<?php if(!isset($_SESSION['login_user'])){ ?>
	<ul>
		<li><a href="http://webdev.cs.umt.edu/~ls117542/"> Welcome!</a></li>
		<li><a href="http://webdev.cs.umt.edu/~ls117542/Login.php"> Login</a></li>
		<li><a href="http://webdev.cs.umt.edu/~ls117542/CreateAccount.php">Create Account</a></li>
		<li><a href="http://webdev.cs.umt.edu/~ls117542/search.php"> Search By Name </a></li>
		<li><a href="http://webdev.cs.umt.edu/~ls117542/searchState.php"> Search By State </a></li>
		<li><a href="http://webdev.cs.umt.edu/~ls117542/searchToxin.php"> Search By Toxin Danger </a></li>
		<li><a href="http://webdev.cs.umt.edu/~ls117542/Invasive.php"> View Invasive Species </a></li>
		<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/schema.php"> Database Schemas</a></li>

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
			<li><a href="http://webdev.cs.umt.edu/~ls117542/Invasive.php"> View Invasive Species </a></li>
			<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/schema.php"> Database Schemas</a></li>
			<li >
                <form method='post' action="">
                <input style="background-color:firebrick; color: white;" type="submit" value="Logout" name="logout">
                </form>
            </li>	
		</ul>
	<?php } ?>


        <div class="pageContent">
            <p>These are subject to change if necessary. Also Some data values are long strings of text which makes them appear messy in select. Some pictures do not contain all values due to length.</p>
            <img src="./Media/Animal.PNG" alt="Animal Schema">
            <img src="./Media/Animalvalues.PNG" alt="Animal Schema values">
            <br />
            <img src="./Media/CommonName.PNG" alt="CommonName Schema">
            <img src="./Media/CommonNamevalues.PNG" alt="CommonName Schema values">
            <br />
            <img src="./Media/Description.PNG" alt="Descrition Schema">
            <img src="./Media/Descriptionvalues.PNG" alt="Descrition Schema values">
            <br />
            <img src="./Media/Toxins.PNG" alt="Toxins Schema">
            <img src="./Media/Toxinsvalues.PNG" alt="Toxins Schema values">
            <br />
            <img src="./Media/LifeStyle.PNG" alt="LifeStyle Schema">
            <img src="./Media/LifeStylevalues.PNG" alt="LifeStyle Schema values">
            <br />
            <img src="./Media/Habitat.PNG" alt="Habitat Schema">
            <img src="./Media/Habitatvalues.PNG" alt="Habitat Schema values">
            <br />
            <img src="./Media/States.PNG" alt="States Schema">
            <img src="./Media/Statesvalues.PNG" alt="States Schema values">
            <br />
            <img src="./Media/Invasive.PNG" alt="Invasive Schema">
            <img src="./Media/Invasivevalues.PNG" alt="Invasive Schema values">
            <br />
            <img src="./Media/Inside.PNG" alt="Inside Schema">
            <img src="./Media/Insidevalues.PNG" alt="Inside Schema values">
            <br />
            <p>No values in these sections. User input.</p>
            <img src="./Media/Users.PNG" alt="Users Schema">
            <img src="./Media/List.PNG" alt="List Schema">
            <img src="./Media/ListAnimals.PNG" alt="ListAnimals Schema">
        </div>

</body>

</html>
