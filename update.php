<?php
// Including the header file
include('header.php');

// Including the file containing database connection details
include('mysqli_connect.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Extracting and sanitizing form inputs
    if (isset($_POST['blogpost_id'])) {
        $blogpost_id = mysqli_real_escape_string($dbc, trim($_POST['blogpost_id']));
    } else {
        $blogpost_id = "";
    }

    if (isset($_POST['blogpost_tittle'])) {
        $blogpost_tittle = mysqli_real_escape_string($dbc, trim($_POST['blogpost_tittle']));
    } else {
        $blogpost_tittle = "";
    }

    if (isset($_POST['blogpost_body'])) {
        $blogpost_body = mysqli_real_escape_string($dbc, trim($_POST['blogpost_body']));
    } else {
        $blogpost_body = "";
    }

    // Check if blogpost_tittle and blogpost_body are not empty
    if ($blogpost_tittle != '' && $blogpost_body != '') {
        // Update blog post in the database
        $query = "UPDATE blogposts SET blogpost_body = '$blogpost_body' WHERE blogpost_id = $blogpost_id";
        $results = mysqli_query($dbc, $query);

        $query = "UPDATE blogposts SET blogpost_tittle = '$blogpost_tittle' WHERE blogpost_id = $blogpost_id";
        $results = mysqli_query($dbc, $query);

        // Display success message if update was successful, otherwise display error message
        if ($results) {
            echo "<h3 style=\"background-color:green;\">It worked! Your blog post was updated!</h3>";
        } else {
            echo "There was an error: " . mysqli_error($dbc);
        }
    } else {
        // Handling empty input fields
        if ($blogpost_tittle == ''){
            // Prompting the user to fill out the blogpost tittle
            echo "<br>Please fill out the blogpost tittle!";
        }
        // Prompting the user to fill out the blogpost body
        if ($blogpost_body == ''){
            echo "<br>Please fill out the blogpost body!";
        }
    }
}

// If blogpost_id is provided via GET method, fetch the blog post details
if (isset($_GET['blogpost_id'])) {
    $blogpost_id = mysqli_real_escape_string($dbc, trim($_GET['blogpost_id']));
    $query = "SELECT blogpost_body FROM blogposts WHERE blogpost_id = '$blogpost_id'";
    $sticky_results = mysqli_query($dbc, $query);
    $sticky_row = mysqli_fetch_array($sticky_results, MYSQLI_ASSOC);
    $sticky_comment = $sticky_row['blogpost_body'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Page</title>
</head>
<body>
<form action="update.php" method="post">
    <fieldset>
        <legend>Please enter your updated blog post entry:</legend>
        <!-- Hidden input field to store blogpost_id -->
        <input type="hidden" name="blogpost_id" value="<?php if (isset($blogpost_id)) {echo $blogpost_id;}?>">
        Please enter a new blog post title: <br>
        <input type="text" name="blogpost_tittle" value="<?php if (isset($blogpost_tittle)) {echo $blogpost_tittle;}?>"><br>
        Please enter your body: <br>
        <textarea name="blogpost_body"><?php if (isset($blogpost_body)) {echo $blogpost_body;}?></textarea><br>
        <input type="submit" name="submit" value="Submit">
    </fieldset>
</form>
<?php
// Including the footer file
include('footer.php');
?>
</body>
</html>
