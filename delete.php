<?php
// Include the database connection file at the top of the file
include("connection.php");

// Escape the $_GET['id'] parameter and assign it to $updateid
$updateid = mysqli_real_escape_string($conn, $_GET['id']);

// Define the delete query with the escaped $updateid value
$query = "DELETE FROM registered WHERE user_id='$updateid';";

// Execute the query using mysqli_query() and check for errors
if (mysqli_query($conn, $query)) {
   echo "Record deleted successfully";
} else {
   echo "Error deleting record: " . mysqli_error($conn);
}

// Close the database connection when finished
mysqli_close($conn);
?>
<html>
<meta http-equiv = "refresh" content = "0; url = http://localhost/crud/display.php" />
</html>