<?php 
// Including the header file
include ('header.php');

// Including the file containing database connection details
include ('mysqli_connect.php');

// Same page delete code
if (isset($_GET['delete_id'])){
    // Get the ID of the blog post to be deleted
    $delete_id = mysqli_real_escape_string($dbc, trim($_GET['delete_id']));
    
    // Delete comments associated with the blog post
    $delete_comments_query = "DELETE FROM comments WHERE blogpost_id = '$delete_id'";
    $delete_comments_results = mysqli_query($dbc, $delete_comments_query);
    
    // Delete the blog post
    $delete_query = "DELETE FROM blogposts WHERE blogpost_id = '$delete_id'";
    $delete_results = mysqli_query($dbc, $delete_query);
    
    // Display a delete message if successful
    if ($delete_results){
        echo "<h3 style= \"background-color:red;\">THE BLOG HAS BEEN DELETED!</h3><br>";
    }
} else {
    $delete_id = "";
}

$records = 0;
$display = 5; // Number of records to show per page

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
    $pages = $_GET['p'];
} else { // Need to determine.
    // Count the number of records:
    $q = "SELECT COUNT(blogpost_id) FROM blogposts";
    $r = mysqli_query ($dbc, $q);
    $rowp = mysqli_fetch_array ($r, MYSQLI_NUM);
    $records = $rowp[0];
}

// Calculate the number of pages...
if ($records > $display) { // More than 1 page.
    $pages = ceil ($records/$display);
} else {
    $pages = 1;
}

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
    $start = $_GET['s'];
} else {
    $start = 0;
}

// Pagination code end

// Default is by most recent date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'date_desc';

// Determine the sorting order:
switch ($sort) {
    case 'date_desc':
        $order_by = 'blogpost_timestamp DESC';
        break;
    case 'date_asc':
        $order_by = 'blogpost_timestamp ASC';
        break;
    default:
        $order_by = 'blogpost_timestamp DESC';
        $sort = 'date_desc';
        break;
}

// Sort buttons
echo '<div align="center">';
echo '<strong> Sort By: </strong>';
echo '<a href="?sort=date_desc">Most Recent</a> |';
echo '<a href="?sort=date_asc">Oldest</a>';
echo '</div>';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Index Page</title>
    <!-- Linking to external CSS file -->
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<h1>Blog Posts</h1>
<?php
// Check if the database connection is successful
if (!$dbc) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Querying the database to select all entries from the blogposts table
$query = "SELECT * FROM blogposts ORDER BY $order_by LIMIT $start, $display";
$result = mysqli_query($dbc, $query);
    
// Checking if the query was successful
if ($result) {
    // Informing the user that the query was successful
    echo "Query executed successfully.<br>";
} else {
    // Informing the user about an error that occurred during the query execution and displaying the error message
    echo "Error executing query: " . mysqli_error($dbc);
}
// Looping through each row fetched from the result set
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

    // Displaying each entry in a styled card format
    echo "<div class=\"w3-card-4\" style=\"width: 50%;\">";
    echo "<header class=\"w3-container w3-green\">";
    echo "<h1>" . $row['blogpost_tittle'] . "</h1>";
    echo "</header>";
    echo "<div class=\"w3-container\">";
    echo "<p>" . $row['blogpost_body'] . "</p>";
    echo "</div>";
    echo "<footer class=\"w3-container w3-blue\">";
    echo "<h5>" . "Time stamp: " . $row['blogpost_timestamp'] . "</h5>";
    echo "<h5>";
    echo "<a href='view_comments.php?blogpost_id=".$row['blogpost_id']."'>View comments | </a>";
    if(isset($_SESSION['user_id'])) {
        echo "<a href='newcomment.php?blogpost_id=".$row['blogpost_id']."'>Leave a comment</a>"; 
    }
    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == 5) {
        echo "<a href='update.php?blogpost_id=".$row['blogpost_id']."'> | Update Blog | </a>";
        echo "<a href='index.php?delete_id=".$row['blogpost_id']."'>Delete Blog Post</a>";
    }
    echo "</h5>";
    echo "</footer>"; 
    echo "</div><br><br>";
}

// Pagination previous and next page buttons/links
if ($pages > 1) {
    echo '<br /><p>';
    $current_page = ($start/$display) + 1;

    // If it's not the first page, make a Previous button:
    if ($current_page != 1) {
        echo '<a href="?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
    }

    // Make all the numbered pages:
    for ($i = 1; $i <= $pages; $i++) {
        if ($i != $current_page) {
            echo '<a href="?s=' . (($display * ($i - 1))) . '&p=' . $i . '&sort=' . $sort . '">' . $i . '</a> ';
        } else {
            echo $i . ' ';
        }
    } // End of FOR loop.

    // If it's not the last page, make a Next button:
    if ($current_page != $pages) {
        echo '<a href="?s=' . (($display * $current_page)) . '&p=' . ($current_page + 1) . '&sort=' . $sort . '">Next</a> ';
    }
    
    echo '</p>'; 
}

// Including the footer file
include('footer.php');
?>
</body>
</html>
