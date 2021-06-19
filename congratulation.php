<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
    header("location:login.php");  
} 
?>
<html>
<head><link rel="stylesheet" href="congratulation.css"></head>
<body>
<header><h1> E-Learning   <span style="float: right; padding-right:25px; font-weight: bold; letter-spacing: 2px; font-size: 35px; padding-top:0.5px">
 Hi! <?=strstr($_SESSION['sess_user'],'@',true);?>
<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">&#9776;</button>
	<div id="myDropdown" class="dropdown-content" style="font-size:15px; font-weight:bold;">
		<a href="logout.php">Logout</a>
	</div>
</div>

<script>
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

</script>
</h1>
</header>
<div align="center">
	<p class ="cmsg"> Congratulation!! Great Work</p>
	<p class="score" style="color:black">You have scored <?php echo $_GET['percentage']; ?>%</p>
</div>
<form name="login" method="post" action="home.php">
<center>
	<input type="submit" name="Back" value="Back" class="Back">
</center>
</form>
<h3 style='padding:0px 130px'>See you again Enrollhere</h3>
<form method="POST" action="">
<?php
$con=mysqli_connect("localhost","siva","siva123","project");
	if($con==false){
		die("ERROR: Could not connect. ". mysqli_connect_error());
	}
	$sql="select course_name, DATE_FORMAT(start_date,'%d-%b-%Y') as start_date,DATE_FORMAT(end_date,'%d-%b-%Y') as end_date, assessment_status, substring_index(trainer_email,'@',1) as trainer_email,participant_limit from course_details, scheduled_courses where course_details.course_id=scheduled_courses.course_id and DATE_FORMAT(start_date,'%d-%b-%Y')>DATE_FORMAT(now(),'%d-%b-%Y')order by DATE_FORMAT(start_date,'%d-%b-%Y'),participant_limit ASC LIMIT 3;";
	$result = mysqli_query($con,$sql);
?>
<center>
<?php
		if(mysqli_num_rows($result)>0)
		{
			echo "<table style='border: 1px solid black; border-collapse: collapse; margin-top:20px'>";
			echo "<tr style='text-align: center; background-color: #000000; color: white;  font-size: 18px;'>";
			echo "<th style='border: 1px solid black;padding:10px'>Select</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Course Name</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Start Date</th>";
			echo "<th style='border: 1px solid black;padding:10px'>End Date</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Assessment Status</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Trainer</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Seat Availability</th>";
			echo "</tr>";
			while($row=mysqli_fetch_array($result))
			{
				$cname=$row['course_name'];
				$date=$row['start_date'];
				$end_date=$row['end_date'];
				$test=$row['assessment_status'];
				echo "<tr style='text-align: center; border: 1px solid black; font-size:18px'>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>"?><input type="radio" name="select_enroll" value="<?php echo $date,",",$cname,",",$end_date,",",$test; ?>"><?php echo "</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['course_name']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['start_date']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['end_date']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['assessment_status']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['trainer_email']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['participant_limit']."</td>";
				echo "</tr>";
			}
			echo "</table>";
			mysqli_free_result($result);
		}
	mysqli_close($con);
?>
</center><br>
<div align=center>
	<input type="submit" name="submit" value="Enroll Now" class="enrollnow">
</div><br>
</form>
</body>
</html>
<?php
	if(isset($_POST["submit"]))
	{
		$con = mysqli_connect("localhost","siva","siva123","project");
		$user_name=$_SESSION['sess_user'];
		$select=$_POST['select_enroll'];
		$str_arr = explode (",",$select); 
		if (!empty($select))
		{			
		$dat = $str_arr[0];
		$date= date('Y-m-d', strtotime($dat));
		$edate = $str_arr[2];;
		$end_date=date('Y-m-d', strtotime($edate));
		$cname=$str_arr[1];
		$test=$str_arr[3];
		$o = "select course_id from course_details where course_name='".$cname."';";
		$result3=mysqli_query($con,$o);
		while($row=mysqli_fetch_row($result3))
		{
			$cid = $row[0];
		}
		$q = "CALL enroll_course (".$cid.",'".$date."','".$end_date."','".$user_name."','".$test."',@output);";
		$result=mysqli_query($con,$q);
		$result2=mysqli_query($con,'SELECT @output');
		$r = mysqli_fetch_assoc($result2);
		$p = $r['@output'];
		?><center><?php echo $p;?></center><?php
		}
		
	}
	
?>

