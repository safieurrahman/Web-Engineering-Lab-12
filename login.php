<?php
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
$role=$_POST['role'];
    
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "");
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
$role = mysql_real_escape_string($role);
    
    
// Selecting Database
$db = mysql_select_db("attendance_system", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from user where password='$password' AND fullname='$username' AND role='$role' ", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
    if ($role == "teacher"){
        header("location: teacher.php?username=$username"); // Redirecting To Other Page
    }
    
    else if ($role == "student"){
        header("location: student.php?username=$username"); // Redirecting To Other Page
    }

} else {
$error = "Username or Password is invalid";
print $error;
}
mysql_close($connection); // Closing Connection
}
}
?>