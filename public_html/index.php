
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
<html lang="en">
<head>
	<title> Welcome Page </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php if(!isset($_SESSION['login_user'])){ ?>
	<ul>
		<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/"> Welcome!</a></li>
		<li><a href="http://webdev.cs.umt.edu/~ls117542/Login.php"> Login</a></li>
		<li><a href="http://webdev.cs.umt.edu/~ls117542/CreateAccount.php">Create Account</a></li>
		<li><a href="http://webdev.cs.umt.edu/~ls117542/search.php"> Search By Name </a></li>
		<li><a href="http://webdev.cs.umt.edu/~ls117542/searchState.php"> Search By State </a></li>
		<li><a href="http://webdev.cs.umt.edu/~ls117542/searchToxin.php"> Search By Toxin Danger </a></li>
		<li><a href="http://webdev.cs.umt.edu/~ls117542/Invasive.php"> View Invasive Species </a></li>
		<li><a href="http://webdev.cs.umt.edu/~ls117542/schema.php"> Database Schemas</a></li>

	</ul>
	<?php } ?>
	<?php if(isset($_SESSION['login_user'])){ ?>
		<ul> 
			<li><a class="active" href="http://webdev.cs.umt.edu/~ls117542/"> Welcome!</a></li>
            <li><a href="http://webdev.cs.umt.edu/~ls117542/Home.php"> Home </a></li>
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
	<?php } ?>
	<div class="pageContent">
		<div class="pageDiv">
			<h4 style="color:red;">Please do NOT enter any personal information on this site</h4>
			<h5>Warning Data may not be 100% accurate.</h5>
			<h3> Welcome! You can:</h3>
			<p>Search by animals scientific name</p>
			<p>Search by State for animals</p>
			<p>Search By Danger level</p>
			<p>View Invasive Species</p>
			<p> Create an Account</p>
			<p>Login</p>
			<p>Once Logged in you can:</p>
			<p>Create a List</p>
			<p>Add animals to your list</p>
			<p>View Your Lists</p>
			<p>Reset the User Databse: Notice you cannot log in again after with the account you made</p>

			<div id=userHelp>
			<dl>
			<dt><b>1. Function name:</b> createAccount</dt>
			<dd><b>URL:</b> <a href ="http://webdev.cs.umt.edu/~ls117542/CreateAccount.php">http://webdev.cs.umt.edu/~ls117542/CreateAccount.php</a> </dd>
			<dd><b>Function type:</b> Insert</dd>
			<dd><b>Description:</b> Allow users to create an account thus adding their information into the Users Table</dd>
			<dd><b>Primary users:</b> Users wanting to build lists, can be any demographic </dd>
			<dd><b>Tables affected:</b> Users</dd>
			<dd><b>Sample input:</b> username = myusername, password = mypass re-enter password = mypass</dd>
			<dd><b>Sample output: </b> Success message will pop up and you can now log in at your own leisure.</dd>
			<dd><b>Notes:</b> This is not a very interesting function but it is necessary to be able to do this for ohter functions.
			This function has some error checking for example it will not let users create an account with an
			existing username. Also checks that the re-enterd password does match the orinal password. </dd>

			<dt><b>2. Function name:</b> userLogin</dt>
			<dd><b>URL:</b>  <a href ="http://webdev.cs.umt.edu/~ls117542/Login.php">http://webdev.cs.umt.edu/~ls117542/Login.php</a> </dd>
			<dd><b>Function type:</b> Security/query </dd>
			<dd><b>Description:</b>Allow users to login to their account to view their lists as well as create lists on their account. (Users cannot see each other's lists)</dd>
			<dd><b>Primary users:</b> Any user with an account </dd>
			<dd><b>Tables affected:</b> Users</dd>
			<dd><b>Sample input:</b> username = myusername, password = mypass</dd>
			<dd><b>Sample output: </b> User will be redirected to the post-login home page</dd>
			<dd><b>Notes:</b> Although this function doesn't touch many 
			tables I did have to do some playing around with SESSION details and permisions 
			to actually hava a functioning log-in.
			This function has error checking to check that the username and password are in the 
			databse and that they are both entered.</dd>

			<dt><b>3. Function name:</b> getAnimalByName</dt>
			<dd><b>URL:</b>  <a href ="http://webdev.cs.umt.edu/~ls117542/search.php">http://webdev.cs.umt.edu/~ls117542/search.php</a> </dd>
			<dd><b>Function type:</b> Query </dd>
			<dd><b>Description:</b> Allow users to search for an animal by its scientific name and view related info about that animal.</dd>
			<dd><b>Primary users:</b> Anyone on the site should be able to do this. </dd>
			<dd><b>Tables affected:</b> Animal, CommonName, Description, LifeStyle, Habitat, Toxins </dd>
			<dd><b>Sample input:</b> Genus =  Thamnophis, Species = sirtalis </dd>
			<dd><b>Sample output: </b> The user will see a table displayed with information about the animal they searched for.</dd>
			<dd><b>Notes:</b> This function grabs info from many tables to display. There is also minor error
			checking just to make sure the user enters search details.</dd>

			<dt><b>4. Function name:</b> createTable</dt>
			<dd><b>URL:</b>  <a href ="http://webdev.cs.umt.edu/~ls117542/CreateTable.php">http://webdev.cs.umt.edu/~ls117542/CreateTable.php</a> </dd>
			<dd><b>Function type:</b> Insert  </dd>
			<dd><b>Description:</b> Allow a user to create lists of animals. </dd>
			<dd><b>Primary users:</b> : Any user with an account. </dd>
			<dd><b>Tables affected:</b> List</dd>
			<dd><b>Sample input:</b> List Name = Venomous Snakes in Montana  Description= list of all of the venomous snakes in Montana </dd>
			<dd><b>Sample output: </b> Notification will let user know that the list has been created and they can now add to that table in the add to list tab.</dd>
			<dd><b>Notes:</b> This function is fairly simple but the userid does have to be grabbed from the session details.</dd>

			<dt><b>5. Function name:</b> addToTable</dt>
			<dd><b>URL:</b>  <a href ="http://webdev.cs.umt.edu/~ls117542/addTable.php">http://webdev.cs.umt.edu/~ls117542/addTable.php</a> </dd>
			<dd><b>Function type:</b> Insert  </dd>
			<dd><b>Description:</b>  Allow a user to add animals to their list. </dd>
			<dd><b>Primary users:</b> : Any user with an account and a list created. </dd>
			<dd><b>Tables affected:</b> List</dd>
			<dd><b>Sample input:</b> : Drop down box : choose Venomous Snakes in Montana  which was made in function 4. Add Genus =  Thamnophis, Species = sirtalis. Press add  </dd>
			<dd><b>Sample output: </b>A pop up will alert to the user that the animals has been added to the list. They can now go to View Lists to see that the animal is in the Venomous Snakes in Montana list.</dd>
			<dd><b>Notes:</b> You could also add Genus =  Crotalus, Species = viridis to the same list. It was 
			more of a struggle than id like to admit to get the drop down box to work properly because I was un aware<
			that php on the page couldn't see eachother. I had the query outside of the php that ran the table.</dd>

			<dt><b>6. Function name:</b> viewTables</dt>
			<dd><b>URL:</b>  <a href ="http://webdev.cs.umt.edu/~ls117542/ViewTables.php">http://webdev.cs.umt.edu/~ls117542/ViewTables.php</a> </dd>
			<dd><b>Function type:</b> Query/security  </dd>
			<dd><b>Description:</b>  Allow a user to view all of the tables they have made.  </dd>
			<dd><b>Primary users:</b> : Any user with an account and a list created. </dd>
			<dd><b>Tables affected:</b> List, Users, Animal, ListAnimals,Description</dd>
			<dd><b>Sample input:</b> Click on View Lists. </dd>
			<dd><b>Sample output: </b> The user can see the names and descriptions of their lists and the animals in those lists.</dd>
			<dd><b>Notes:</b>If I had more time I probably would have made the lists shrink and expand to show or hide details.</dd>

			<dt><b>7. Function name:</b> SearchState</dt>
			<dd><b>URL:</b>  <a href ="http://webdev.cs.umt.edu/~ls117542/searchState.php">http://webdev.cs.umt.edu/~ls117542/searchState.php</a> </dd>
			<dd><b>Function type:</b> Query  </dd>
			<dd><b>Description:</b>  Allows the user to search for animals in a particular state. </dd>
			<dd><b>Primary users:</b> : Any user on the site.</dd>
			<dd><b>Tables affected:</b> Animal, CommonName, Description, Toxins, Habitat, Inside, States</dd>
			<dd><b>Sample input:</b> Enter: MT </dd>
			<dd><b>Sample output: </b> Displays information about animals in that state.</dd>
			<dd><b>Notes:</b>This is intersting because animals and states are not directly linked and we must go though the Inside relational table. 
			The View Invasive is also complicated in this way but more so because it has to match States and Invasion and Habitat with AnimalID.</dd>

			</dl>
			</div>

		</div>
	</div>
</body>

</html>
