<!--Add the search form-->
<form method="GET" action="">
    <input type="text" name="search" placeholder="Search by First Name">
    <input type="submit" value="Search">
</form>

<?php
validate the connection file
if (file_exists('connection.php')) {
    require_once('connection.php');
} else {
    die('Connection file not found.');
}

// check if a search query is submitted
if (isset($_GET['search'])) {
    $search = $_GET['search'];

    // use prepared statement to prevent SQL injection
    $query = "SELECT * FROM registered WHERE first_name LIKE ? ORDER BY user_id";
    $stmt = mysqli_prepare($conn, $query);
    if (!$stmt) {
        die('Error executing query: ' . mysqli_error($conn));
    }

    // bind the search parameter
    $searchParam = "%" . $search . "%";
    mysqli_stmt_bind_param($stmt, "s", $searchParam);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
} else {
    // if no search query, retrieve all records
    $query = "SELECT * FROM registered ORDER BY user_id";
    $result = mysqli_query($conn, $query);
}

// print all records
if (mysqli_num_rows($result) > 0) {
    echo "<table border='1' cellspacing='7' width='60%'>
    <tr>
    <th width='5%'>User ID</th>
    <th width='5%'>First Name</th>
    <th width='5%'>Last Name</th>
    <th width='1%'>Gender</th>
    <th width='6%'>Email</th>
    <th width='5%'>Phone</th>
    <th width='6%'>Address</th>
    <th width='30%'>Edit</th>
    </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
            <td>" . $row['user_id'] . "</td>
            <td>" . $row['first_name'] . "</td>
            <td>" . $row['last_name'] . "</td>
            <td>" . $row['gender'] . "</td>
            <td>" . $row['email'] . "</td>
            <td>" . $row['phone'] . "</td>
            <td>" . $row['address'] . "</td>
            <td><table>
            <tr>
              <td>
                <a href='update_design.php?id=$row[user_id]' style='text-decoration:none; display:inline-block; margin-right:10px; border: none; padding: 0;'>
                  <span>
                    <img src='https://img.b2bstatic.com/files/retail_files/Edit_1625138806.png' style='height:20px'><br><p style='color:blue; font-size:12px; font-weight:bold; padding: 0; margin: 0;'>Edit</p>
                  </span>
                </a>
                <a href='delete.php?id=$row[user_id]' target_blank; style='text-decoration:none; display:inline-block; border: none; padding: 0;' onclick='return checkdelete();'>
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
if (isset($stmt)) {
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>