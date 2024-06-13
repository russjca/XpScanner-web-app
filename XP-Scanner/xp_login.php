<?php
session_start();
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'xpscanner_database';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno() ) 
{
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

function validate($data) 
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$username = validate($_POST['username']);
$password = validate($_POST['password']);

if (empty($username)) 
{
	header("Location: login.php?error=Username is required");
	exit();
}
else if (empty($password)) 
{
	header("Location: login.php?error=Password is required");
	exit();
} 
else 
{
	// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
	if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE BINARY username = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

if ($stmt->num_rows > 0) 
{
	$stmt->bind_result($id, $password);
	$stmt->fetch();
	// Account exists, now we verify the password.
	//password_hash in your registration file to store the hashed passwords.
	if (password_verify($_POST['password'], $password)) 
	{
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['name'] = $_POST['username'];
		$_SESSION['password'] = $_POST['password'];
		$_SESSION['id'] = $id;
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			// process the form data
			// redirect the user to another page
			header('Location: main_dash.php');
			exit();
		}
		exit();
	} 
	else 
	{
		// Incorrect password
		header("Location: login.php?error=Incorrect Username or Password!");
	}
} 
else 
{
	// Incorrect username
	header("Location: login.php?error=Incorrect Username or Password!");
}
$stmt->close();
}
}

?>