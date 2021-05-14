<style>

.navbar {
  overflow: hidden;
  background-color: #333;
}
.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: top;
  padding: 24px 30px;
  text-decoration: none;
}
.navbar a.right {
  float: right;
}
</style>

 <header>


 </header> 
 <?php 
 session_start();
 $uname=$_SESSION["username"];
 $resultarray=array();
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
        $select ="select mseatname from booking";
        $result=$conn->query($select);
	while($rw=$result->fetch_assoc()){
		$ars=explode(",",$rw["mseatname"]);
		foreach($ars as $ar)
		{
			array_push($resultarray,$ar);
		}
		
				
	}
   // print_r($resultarray);
     $conn->close();
	 
	 
    }
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
<div class="navbar">
  <a href="index.html">Home</a>
  <a href="welcome.html">view</a>
  <a href="#">Contact as</a>
  <a href="#" class="right">Admin</a>
</div>
       <title>Movie Seat Booking</title>
    <link rel="stylesheet" href="style-booking.css">
    
    <style>
      
    </style>
  </head>
  <body style="background-color: LightGray;">
		
 <form name="myform"  action="booking.php" method="POST" >
    <div class="movie-container">
      <label style="font-size: 1em;">Pick a movie:</label>
      <select id="movie">
        <option value="10">Jurassic Park ($10)</option>
        <option value="12">Logan ($12)</option>
        <option value="8">Avengers Infinity War ($8)</option>
      </select>
    </div>
<input type="hidden" id="mname" name="mname" value=""/>
<input type="hidden" id="mcount" name="count" value=""/>
<input type="hidden" id="mtotal" name="total" value=""/>
<input type="hidden" id="mseatnumber" name="seatnumber" value=""/>
<input type="hidden" id="muser" name="user" value="<?php echo $uname;?>"/>
    <ul class="showcase">
      <li>
        <div id="seat" class="seat"></div>
        <small class="status" style="font-size: 1em;">N/A</small>
      </li>
      <li>
        <div id="seat" class="seat selected"></div>
        <small class="status" style="font-size: 1em;">Selected</small>
      </li>
      <li>
        <div id="seat" class="seat occupied"></div>
        <small class="status" style="font-size: 1em;">Occupied</small>
      </li>
    </ul>

    <div class="container">
      <div class="screen"></div>

      <div class="row">
        <div id="A1" class="seat"></div>
        <div id="A2" class="seat"></div>
        <div id="A3" class="seat"></div>
        <div id="A4" class="seat"></div>
        <div id="A5" class="seat"></div>
        <div id="A6" class="seat"></div>
        <div id="A7" class="seat"></div>
        <div id="A8" class="seat"></div>
      </div>
      <div class="row">
        <div id="B1" class="seat"></div>
        <div id="B2" class="seat"></div>
        <div id="B3" class="seat"></div>
        <div id="B4" class="seat occupied"></div>
        <div id="B5" class="seat occupied"></div>
        <div id="B6" class="seat"></div>
        <div id="B7" class="seat"></div>
        <div id="B8" class="seat"></div>
      </div>
      <div class="row">
        <div id="C1" class="seat"></div>
        <div id="C2" class="seat"></div>
        <div id="C3" class="seat"></div>
        <div id="C4" class="seat"></div>
        <div id="C5" class="seat"></div>
        <div id="C6" class="seat"></div>
        <div id="C7" class="seat occupied"></div>
        <div id="C8" class="seat occupied"></div>
      </div>
      <div class="row">
        <div id="D1" class="seat"></div>
        <div id="D2" class="seat"></div>
        <div id="D3" class="seat"></div>
        <div id="D4" class="seat"></div>
        <div id="D5" class="seat"></div>
        <div id="D6" class="seat"></div>
        <div id="D7" class="seat"></div>
        <div id="D8" class="seat"></div>
      </div>
      <div class="row">
        <div id="E1" class="seat"></div>
        <div id="E2" class="seat"></div>
        <div id="E3" class="seat"></div>
        <div id="E4" class="seat occupied"></div>
        <div id="E5" class="seat occupied"></div>
        <div id="E6" class="seat"></div>
        <div id="E7" class="seat"></div>
        <div id="E8" class="seat"></div>
      </div>
      <div class="row">
        <div id="F1" class="seat"></div>
        <div id="F2" class="seat"></div>
        <div id="F3" class="seat"></div>
        <div id="F4" class="seat"></div>
        <div id="F5" class="seat occupied"></div>
        <div id="F6" class="seat occupied"></div>
        <div id="F7" class="seat occupied"></div>
        <div id="F8" class="seat"></div>
      </div>
    </div>

    <p class="text" style="font-size: 1em;margin:0px 0px 15px 0px">   
      You have selected <span  id="count">0</span> seats for a price of $<span 
        id="total"
        >0</span
      >
    </p>

   <input type="submit" name="" value="Book">
    
</form>
    <script>
     var seatnumber="";
      var count=0;
	   var seats=document.getElementsByClassName("seat");
	  var parsedArr=<?php echo json_encode($resultarray); ?>;
	  for(var j=0;j<parsedArr.length;j++)
	  {
		  var res=parsedArr[j];
		  if(res!="")
		  {
		  var element=document.getElementById(res);
		  element.classList.add("occupied");
		  }
	  }
	  
	  
     
	  
      for(var i=0;i<seats.length;i++){
        var item=seats[i];
        
        item.addEventListener("click",(event)=>{
          var price= document.getElementById("movie").value;

          if (!event.target.classList.contains('occupied') && !event.target.classList.contains('selected') ){
          count++;
          
          var total=count*price;
          event.target.classList.add("selected");
          document.getElementById("count").innerText=count;
          document.getElementById("total").innerText=total;
		 var ddl= document.getElementById("movie");
		  document.getElementById("mname").value =ddl.options[ddl.selectedIndex].text;
document.getElementById("mcount").value =count;
          document.getElementById("mtotal").value =total;
		  if(seatnumber=="")
		  {
		  seatnumber=event.target.id;
		  }
		  else
		  {
		  seatnumber=seatnumber+","+event.target.id;
		  }
		  
		  document.getElementById("mseatnumber").value =seatnumber;
          }
        })
      }
	  
	  
    </script>
  </body>
</html>
