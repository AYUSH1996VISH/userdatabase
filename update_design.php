<?php
// Include the connection to the database at the top of the file
include("connection.php");

$updateid = mysqli_real_escape_string($conn, $_GET['id']);

$query = "SELECT * FROM registered WHERE user_id = '$updateid'";
$stmt = mysqli_prepare($conn, $query);
if (!$stmt) {
    die('Error executing query: ' . mysqli_error($conn));
}
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>User Details update</title>
</head>
<body>
    <div class="container">
        <form action="#" method="POST">
        <div class="title">
            Update User Details
        </div>
        <div class="form">

            <div class="intput_user">
                <label for=""> First Name</label>
                <input type="text" value="<?php echo htmlspecialchars($row['first_name']); ?>" class="input" name="fname">
            </div>
                        <div class="intput_user">
                <label for="">Last Name</label>
                <input type="text" value="<?php echo htmlspecialchars($row['last_name']); ?>" class="input" name="lname">
            </div>
                        <div class="intput_user">
                <label for="">Company</label>
                <input type="text" value="<?php echo htmlspecialchars($row['password']); ?>" class="input" name="password">
            </div>
                        <div class="intput_user">
                <label for="">Designation</label>
                <input type="text" value="<?php echo htmlspecialchars($row['confpassword']); ?>" class="input" name="conpassword">
            </div>
                        <div class="intput_user">
                <label for="">Gender</label>
                <select class="selectbox" name="gender">
    <option value="not_selected" <?php if ($row['gender'] === 'not_selected') echo 'selected'; ?>>Select</option>
    <option value="male" <?php if ($row['gender'] === 'male') echo 'selected'; ?>>Male</option>
    <option value="female" <?php if ($row['gender'] === 'female') echo 'selected'; ?>>Female</option>
</select>

            </div>
                        <div class="intput_user">
                <label for="">Email Address</label>
                <input type="text" value="<?php echo htmlspecialchars($row['email']); ?>" class="input" name="email">
            </div>
                    <div class="intput_user">
            <label for="">Phone No.</label>
            <input type="text" value="<?php echo htmlspecialchars($row['phone']); ?>" class="input" name="mobile">
        </div>
                                    <div class="intput_user">
                <label for="">Address</label>
                <textarea cols="30" rows="10" class="textarea" name="addinfo"><?php echo htmlspecialchars($row['address']); ?></textarea>
            </div>
            <div class="intput_user terms">
            <label class="check">
            <input type="checkbox">
            <span class="checkmark"></span>
            </label>
            <p>Terms and Conditions</p>
        </div>
        <div class="input_user" style="padding: 10px 10px 10px;">
  <input type="submit" value="Update Details" class="btn" name="update" style="width: 40%; padding: 10px 10px; color: black; background-color: #F4B400; border: none; border-radius: 10px; cursor: pointer; box-shadow: 0px 2px 5px #888888; transition: background-color 0.3s ease;">
</div>
        </div>
</form>
    </div>
</body>
</html>
<?php include("connection.php"); ?>
<?php
if($_POST['update'])
{
   $firstname = $_POST['fname'];
   $lastname = $_POST['lname'];
   $pwd = $_POST['password'];
   $conpwd = $_POST['conpassword'];
   $gender = $_POST['gender'];
   $uemail = $_POST['email'];
   $phone = $_POST['mobile'];
   $address = $_POST['addinfo'];

   $query = "update registered set first_name='$firstname',last_name='$lastname',password='$pwd',confpassword='$conpwd',gender='$gender',email='$uemail',phone='$phone',address='$address' where user_id='$updateid'";
   $data = mysqli_query($conn,$query);
   if($data)
   {
    echo "<script>alert('Record updated')</script>";
?>
 <meta http-equiv = "refresh" content = "0; url = http://localhost/crud/display.php" />
<?php
   }
   else
   {
    echo "failed";
   }
}
?>
