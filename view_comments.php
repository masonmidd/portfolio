<?php 
// Including the header file
include ('header.php');
include ('mysqli_connect.php');

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Comments</title>
    <!-- Linking to external CSS file -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<h1>Comments</h1>
<?php
// Check if the blogpost_id is set in the $_GET field
if(isset($_GET['blogpost_id'])) {
    // Sanitize and get the blogpost_id
    $blogid = mysqli_real_escape_string($dbc, trim($_GET['blogpost_id']));
    
    // Query to fetch comments for the specific blogpost
    $query = "SELECT * FROM comments WHERE blogpost_id = $blogid";
    
    // Execute the query
    $result = mysqli_query($dbc, $query);
    
    // Check if there are any comments
    if(mysqli_num_rows($result) > 0) {
        // Loop through each comment
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // Displaying each entry in a styled card format
            echo "<div class=\"w3-card-4\" style=\"width: 50%;\">";
            echo "<header class=\"w3-container w3-green\">";
            echo "<h1>" . "Comment for blogpost ID: " . $row['comment_id'] . "</h1>";
            echo "</header>";
            echo "<div class=\"w3-container\">";
            echo "<p>" . $row['comment_body'] . "</p>";
            echo "</div>";
            echo "<footer class=\"w3-container w3-blue\">";
            echo "<h5>" . "Timestamp " . $row['comment_timestamp'] . "</h5>";
            echo "</footer>"; 
            echo "</div><br><br>";
        }
    } else {
        echo "<p>No comments found for this blogpost.</p>";
    }
} else {
    echo "<p>No blogpost ID provided.</p>";
}

// Including the footer file
include('footer.php');
?>
</body>
</html>
