<?php
session_start();
$uname1 = $_POST['uname'];
$upwd  = $_POST['upswd'];


if (!empty($uname1) || !empty($upwd) )
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
  $SELECT = "SELECT uname1,upswd1 From register Where uname1='$uname1' and upswd1='$upwd' Limit 1";
 //Prepare statement
     $stmt = $conn->prepare($SELECT);
    // $stmt->bind_param("s", $email);
     $stmt->execute();
     //$stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum!=0) {
      $stmt->close();
     
	 $_SESSION["username"]=$uname1;
      header("Location: Welcome.html");
     } else {
      echo '<script type="text/javascript">';
echo 'alert("Invalid Login");';
echo 'window.location.href = "index.html";';
echo '</script>';
	  
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}

