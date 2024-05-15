<?php
session_start();

// Including the header file
include('header.php');

// Including the file containing database connection details
include('mysqli_connect.php');

// Check if user is logged in and user_id is 5
if (!isset($_SESSION['user_id']) || $_SESSION['user_id'] != 5) {
    // Redirecting to login page if user is not logged in or user_id is not 5
    header('Location: http://hbak.uwmsois.com/infost440/assignments/finalproject/login.php');
    exit(); // Stop further execution
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user_id is set in the session
    if (isset($_SESSION['user_id'])) {
        // Get user_id from session
        $user_id = $_SESSION['user_id'];

        // Check if blogpost_tittle and blogpost_body are set in the form
        if (isset($_POST['blogpost_tittle']) && isset($_POST['blogpost_body'])) {
            // Sanitize inputs
            $blogpost_tittle = mysqli_real_escape_string($dbc, $_POST['blogpost_tittle']);
            $blogpost_body = mysqli_real_escape_string($dbc, $_POST['blogpost_body']);

            // Check if blogpost_tittle and blogpost_body are not empty
            if ($blogpost_tittle != '' && $blogpost_body != '') {
                // Insert the blog post into the database
                $query = "INSERT INTO blogposts (user_id, blogpost_tittle, blogpost_body) VALUES ('$user_id', '$blogpost_tittle', '$blogpost_body')";

                if (mysqli_query($dbc, $query)) {
                    // Informing the user that the blog post was added successfully
                    echo "Blog post added successfully!";
                } else {
                    // Informing the user about an error that occurred during the insertion of the blog post and displaying the error message
                    echo "Error: " . $query . "<br>" . mysqli_error($dbc);
                }
            } else {
                // Handling the case where blogpost_tittle is empty
                if ($blogpost_tittle == '') {
                    // Prompting the user to fill out the blogpost tittle
                    echo "<br>Please fill out the blogpost tittle!";
                }
                // Handling the case where blogpost_body is empty
                if ($blogpost_body == '') {
                    // Prompting the user to fill out the blogpost body
                    echo "<br>Please fill out the blogpost body!";
                }
            }
        } else {
            // Informing the user that user ID is not set in the session
            echo "User ID is not set in the session.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add a New Blog Post</title>
</head>
<body>
    <h1>Add a New Blog Post</h1>
    <form action="newblogpost.php?" method="POST">
        <fieldset>
            <legend>Add a new blog post:</legend> 
            Add a title: <input type="text" name="blogpost_tittle" value="<?php if (isset($blogpost_tittle)) {echo $blogpost_tittle;}?>"><br>
            Leave a comment: <textarea name="blogpost_body"><?php if (isset($blogpost_body)) {echo $blogpost_body;}?></textarea><br>
            <input type="submit" name="submit" value="submit">
        </fieldset> 
    </form>
    <?php
    include('footer.php')
    ?>
</body>
</html>
