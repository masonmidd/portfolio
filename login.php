<?php # Script 12.12 - login.php #4
// This page processes the login form submission.
// The script now stores the HTTP_USER_AGENT value for added security.
ob_start(); //Ensures no output is sent to the browser before session_start()
// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Need two helper files:
	require ('login_functions.inc.php');
	require ('mysqli_connect.php');
		
	// Check the login:
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
	
	if ($check) { // OK!
		
		// Set the session data:
		session_start();
		$_SESSION['user_id'] = $data['user_id'];
		$_SESSION['fname'] = $data['fname'];
		
		// Store the HTTP_USER_AGENT:
		$_SESSION['agent'] = md5($_SERVER['HTTP_USER_AGENT']);

		// Redirect:
		redirect_user('loggedin.php');
			
	} else { // Unsuccessful!

		// Assign $data to $errors for login_page.inc.php:
		$errors = $data;

	}
		
	mysqli_close($dbc); // Close the database connection.

} // End of the main submit conditional.

// Create the page:
include ('login_page.inc.php');

ob_end_flush();
?>