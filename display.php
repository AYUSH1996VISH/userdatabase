<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="displaypage.css">
        <title>Display records</title>
    </head>
<body>
<H1 id="dynamic-heading">Database Records</H1>
<h3><a href="form.php"><input type="submit" value="Add User" class="btn" style="width: 10%; padding: 10px 10px; color: white; background-color: purple"></a></h3>

<script>
  // Get the H1 element by its ID
  const heading = document.getElementById("dynamic-heading");

  // Set the color property of the style attribute to a desired color
  heading.style.color = "purple";
</script>
<strong><p style="color: blue; font-size: 18px; padding-bottom: 0px;"><?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_form";

// establish database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check for connection errors
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to get total number of records
$sql = "SELECT COUNT(*) as total FROM registered";

$result = mysqli_query($conn, $sql);

// Check if query was successful
if ($result) {
    $row = mysqli_fetch_assoc($result);
    echo "Total number of records: " . $row['total'];
} else {
    echo "Error: " . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?></p></strong>
<?php
// validate the connection file
if (file_exists('connection.php')) {
    require_once('connection.php');
} else {
    die('Connection file not found.');
}

// use prepared statement to prevent SQL injection
$query = "SELECT * FROM registered ORDER BY user_id DESC";
$stmt = mysqli_prepare($conn, $query);
if (!$stmt) {
    die('Error executing query: ' . mysqli_error($conn));
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// print all records
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellspacing='7' width='100%'>
    <tr>
    <th width='5%'>User ID</th>
    <th width='5%'>First Name</th>
    <th width='5%'>Last Name</th>
    <th width='5%'>Company</th>
    <th width='5%'>Designation</th>
    <th width='1%'>Gender</th>
    <th width='6%'>Email</th>
    <th width='5%'>Phone</th>
    <th width='6%'>Address</th>
    <th width='50%'>Edit</th>
    </tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>".$row['user_id']."</td>
            <td>".$row['first_name']."</td>
            <td>".$row['last_name']."</td>
            <td>".$row['password']."</td>
            <td>".$row['confpassword']."</td>
            <td>".$row['gender']."</td>
            <td>".$row['email']."</td>
            <td>".$row['phone']."</td>
            <td>".$row['address']."</td>
            <td><table style='width=100%; background-color: #f9f9f9;'>
            <tr>
              <td>
                <a href='update_design.php?id=$row[user_id]' style='text-decoration:none; display:inline-block; margin-right:10px; border: none; padding: 0;'>
                  <span>
                    <img src='https://img.b2bstatic.com/files/retail_files/Edit_1625138806.png' style='height:20px'><br><p style='color:blue; font-size:12px; font-weight:bold; padding: 0; margin: 0;'>Edit</p>
                  </span>
                </a>
                <a href='delete.php?id=$row[user_id]' target_blank; style='text-decoration:none; display:inline-block; border: none; padding: 0;' onclick='return confirmDelete()'>
                <span>
                  <img src='https://img.b2bstatic.com/files/retail_files/Delete_1625138800.png' style='height:20px'><br><p style='color:red; font-size:12px; font-weight:bold; padding: 0; margin: 0;'>Delete</p>
                </span>
            </a>
            
              </td>
            </tr>
          </table>
          
          </td>
        </tr>";
}
echo "</table>";
} else {
    echo "No record found";
}

// close the statement and connection
mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
  </body>
  <script>
    function confirmDelete() {
        var confirmation = confirm("Are you sure you want to delete this record?");
        if (confirmation) {
            return true;
        } else {
            return false;
        }
    }
</script>
</html>
