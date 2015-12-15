<?php
   $dbhost = 'localhost';
   $dbuser = 'root';
   $dbpass = '';
   $dbname = 'attendance_system';
   $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
   if(isset($_GET['username'])){
	   $username = $_GET['username'];
       $temp=0;
       $count=0;
		
	   if(! $conn )
	   {
		  die('Could not connect: ' . mysqli_error($conn));
	   }
	   $sql = "SELECT * FROM  user where fullname = '".$username."'";	  
	   $result = mysqli_query($conn, $sql );
	   
	   
	   if(! $result )
	   {
		  die('Could not get data: ' . mysqli_error($conn));
	   }
	   
	   $row = mysqli_fetch_array($result);
	   $userid = $row['id'];
	   
	   $sql = "SELECT * FROM user natural join attendance where id='".$userid."'";
	   $result = mysqli_query($conn, $sql );
	   
	   while($row = mysqli_fetch_array($result))
		   {
              $save = $row['isPresent'];
              if ($save == "Yes")
                {
                   $count++;                
                }
           
              else
              {
                  $temp++;
                  $count++;
              }
		   }
		   
      //echo $count."<br>";
      //echo $temp."<br>";
       
       $attendance= ($count - $temp)/$count;
       if ($attendance < 0.75)
            {           
            echo "Attendance is below 75%";
            }
           
           else if ($attendance > 0.85)
            {           
            echo "Attendance is in the safe limit";
            }
           
           else 
           {
            echo "Attendance is on the boundry-line (75-85%)";
           }
       //echo $attendance;
       
        
       $sql = "SELECT * FROM user natural join attendance where id='".$userid."'";
	   $result = mysqli_query($conn, $sql );
       
       while($row = mysqli_fetch_array($result))
       {   
            if ($attendance < 0.75)
            {           
            echo "<h2 style=\"color:red\">{$row['email']}</h2> "."<p> {$row['isPresent']}</p> <br> ".
				 "<p> {$row['comments']}</p> <br> ".
				 "<hr><br>";
            }
           
           else if ($attendance > 0.85)
            {           
            echo "<h2 style=\"color:green\">{$row['email']}</h2> "."<p> {$row['isPresent']}</p> <br> ".
				 "<p> {$row['comments']}</p> <br> ".
				 "<hr><br>";
            }
           
           else 
           {
               echo "<h2 style=\"color:yellow\">{$row['email']}</h2> "."<p> {$row['isPresent']}</p> <br> ".
				 "<p> {$row['comments']}</p> <br> ".
				 "<hr><br>";
           }
           
           
       }
	
	   
	   
	   mysqli_close($conn);   
   }
?>