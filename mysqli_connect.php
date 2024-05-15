<?php
//This sets the constants with our connection information
DEFINE ('DB_HOST', 'localhost'); //Database server -- Typically "localhost"
DEFINE ('DB_USER', 'middaugh_middaugh'); //Database User Name
DEFINE ('DB_PASSWORD', 'Bears_34cl'); //Database User Password
DEFINE ('DB_NAME', 'middaugh_finalproject'); //Database Name

//This connects us to the database
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if (!$dbc) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>
