<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>PHP  User lead</title>
</head>
<body>
    <div class="container">
        <form action="#" method="POST">
        <div class="title">
            Registertion form
        </div>
        <div class="form">

            <div class="intput_user">
                <label for=""> First Name</label>
                <input type="text" class="input" name="fname">
            </div>
                        <div class="intput_user">
                <label for="">Last Name</label>
                <input type="text" class="input" name="lname">
            </div>
                        <div class="intput_user">
                <label for="">Company</label>
                <input type="text" class="input" name="password">
            </div>
                        <div class="intput_user">
                <label for="">Designation</label>
                <input type="text" class="input" name="conpassword">
            </div>
                        <div class="intput_user">
                <label for="">Gender</label>
                <select class="selectbox" name="gender">
                    <option value="not selected">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
                        <div class="intput_user">
                <label for="">Email Address</label>
                <input type="text" class="input" name="email">
            </div>
                    <div class="intput_user">
            <label for="">Phone No.</label>
            <input type="text" class="input" name="mobile">
        </div>
                                    <div class="intput_user">
                <label for="">Address</label>
                <textarea cols="30" rows="10" class="textarea" name="addinfo"></textarea>
            </div>
            <div class="intput_user terms">
            <label class="check">
            <input type="checkbox">
            <span class="checkmark"></span>
            </label>
            <p>Terms and Conditions</p>
        </div>
        <div class="input_user" style="padding: 10px 10px 10px;">
            <input type="submit" value="register" class="btn" name="reg" style=" width: 40%; padding: 10px 10px; color: black;">
        </div>

        </div>
</form>
    </div>
</body>
</html>
<?php include("connection.php"); ?>
<?php
if($_POST['reg'])
{
   $firstname = $_POST['fname'];
   $lastname = $_POST['lname'];
   $pwd = $_POST['password'];
   $conpwd = $_POST['conpassword'];
   $gender = $_POST['gender'];
   $uemail = $_POST['email'];
   $phone = $_POST['mobile'];
   $address = $_POST['addinfo'];

   $query = "insert into registered (first_name,last_name,password,confpassword,gender,email,phone,address) values('$firstname','$lastname','$pwd','$conpwd','$gender','$uemail','$phone','$address')";
   $data = mysqli_query($conn,$query);
   if($data)
   {
    echo "Data inserted into database";
   }
   else
   {
    echo "failed";
   }
}
?>
<?php
if(isset($_POST['reg'])) {
    // Code to register the user
    
    // Redirect to display.php
    header("Location: http://localhost/crud/display.php");
    exit;
}
?>


