<?php
session_start();

// Including the header file
include('header.php');

// Including the file containing database connection details
include('mysqli_connect.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    if (isset($_SESSION['user_id'])) {
        // Define variables
        $user_id = $_SESSION['user_id'];
        $blogpost_id = $_GET['blogpost_id'];
        $comment_body = $_POST['comment_body'];

        // Check if comment body is not empty
        if ($comment_body != '') {
            // Informing the user that all of the information was filled out
            echo "<br>All of the information was filled out! ";

            // Insert comment into the comments table
            $query = "INSERT INTO comments (user_id, blogpost_id, comment_body) VALUES ('$user_id', '$blogpost_id', '$comment_body')";
            $result = mysqli_query($dbc, $query);

            if ($result) {
                // Informing the user that the comment was added successfully
                echo "Comment added successfully.";
            } else {
                // Informing the user about an error that occurred during the comment insertion and displaying the error message
                echo "Error: " . mysqli_error($dbc);
            }
        } else {
            // Handling the case where comment is empty
            // Prompting the user to fill out their comment
            echo "<br>Please fill out your comment.<br>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Comment</title>
</head>
<body>
    <h1>Add a Comment</h1>
    <form action="newcomment.php?blogpost_id=<?php echo $_GET['blogpost_id']; ?>" method="POST">
        <fieldset>
            <legend>Add a new comment:</legend>
            <textarea name="comment_body"><?php if (isset($comment_body)) {echo $comment_body;}?></textarea><br>
            <input type="submit" name="submit" value="Submit">
        </fieldset>
    </form>
    <?php include('footer.php') ?>
</body>
</html>
