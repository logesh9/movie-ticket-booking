<?php
session_start();
$mname= $_POST['mname'];
$count  = $_POST['count'];
$price = $_POST['total'];
$seatnumber = $_POST['seatnumber'];
$uname = $_POST['user'];

print_r($_POST);
print_r($_SESSION["username"]);

if (!empty($mname) || !empty($count) || !empty($price))
{

if($count > 4)
{
	echo '<script type="text/javascript">';
echo 'alert("You can not book more than 4 tickets at a time!");';
echo 'window.location.href = "booking.html";';
echo '</script>';
}
else
{
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "accessform";
// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
 
  $INSERT = "INSERT Into booking(mname , count ,total, mseatname,uname)values(?,?,?,?,?)";

      $stmt = $conn->prepare($INSERT);
	  //$select =select * from accessform(mname , count ,total,mseatname) where booking (?,?,?,?)";
      $stmt->bind_param("sssss", $mname,$count,$price,$seatnumber,$uname);
      $stmt->execute();
	  
     $stmt->close();
     $conn->close();
	 echo '<script type="text/javascript">';
echo 'alert("Your booking has been completed !");';
echo 'window.location.href = "Welcome.html";';
echo '</script>';
	 
    }
} 
}
else {
 echo "All field are required";
 die();
}

?>