<?php
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_form";

$conn = mysqli_connect($servername,$username,$password,$dbname);
if($conn)
{
    // echo "Connection Done";
}
else
{
    echo "connection fail".mysqli_connect_error();
}
?>