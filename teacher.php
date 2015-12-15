<?php

$dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname = 'attendance_system';
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
   if(isset($_GET['username'])){
	   $username = $_GET['username'];
		
	   if(! $conn )
	   {
		  die('Could not connect: ' . mysqli_error($conn));
	   }
       
	   $sql = "SELECT * FROM  user where fullname = '".$username."'";	  
	   $result = mysqli_query($conn, $sql );
       
       
       echo "Teacher : ";
       echo $username."<br/>";

	   
	   
	   if(! $result )
	   {
		  die('Could not get data: ' . mysqli_error($conn));
	   }
	   
	   $row = mysqli_fetch_array($result);
       $userid = $row['id'];
	   
	   $sql = "SELECT fullname,email,class FROM user WHERE role = 'student'";
	   $result = mysqli_query($conn, $sql );
       
       while($row = mysqli_fetch_array($result))
		   {
			  echo "<h2>{$row['fullname']}</h2> "."<p> {$row['email']}</p> <br> ".
				 "<p> {$row['class']}</p> <br> ".
				 "<hr><br>";
		   }
	   
	   mysqli_close($conn);
   }

?>
<html>
    <form action="" method="post">
    <label> Safie Ur Rehman : </label>
<input id="session" name="session" placeholder="Present/Absent" type="session">
    
    <label> Umar Hussain : </label>
<input id="session1" name="session1" placeholder="Present/Absent" type="session1">
    
<br>
<br>
<input name="submit" type="submit" value=" Submit Attendance ">
    </form>
    
</html>

<?php


    $sql = "SELECT * FROM attendance ORDER BY classid desc LIMIT 0,1";	  
    $result = mysqli_query($conn, $sql );       
    $row = mysqli_fetch_array($result);

    $save = $row['classid'];
    $save++;

    if(isset($_POST['submit'])){
        
        $temp = $_POST['session'];
        $temp1 = $_POST['session1'];

        echo "<br>";

        $sql="INSERT INTO attendance VALUES('$save','2','$temp')";

        $sql="INSERT INTO attendance VALUES('$save','3','$temp1')";


    }

?>