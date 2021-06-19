<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
    header("location:login.php");
} 
?>
<!DOCTYPE html>
<html>
<head><link rel="stylesheet" href="home.css"></head>
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
<body>
<ul class="navList">
  <li><a href="home.php">Home&nbsp;&#127968;</a></li>
  <li><a href="home2.php" >View Scheduled Courses</a></li>
  <li><a href="home3.php" class="active">View Enrolled Courses</a></li>
  <li><a href="home4.php">View Assessment Results</a></li>
</ul>
<h3>&ensp;&ensp;Enrolled courses</h3>
<center>
<form method="POST" action="enroll_cancle.php">
<?php
	$con = mysqli_connect("localhost","siva","siva123","project");
	$user=$_SESSION["sess_user"];
	
	$query = "SELECT course_name,DATE_FORMAT(sc.start_date,'%d-%b-%Y') as start_date,DATE_FORMAT(sc.end_date,'%d-%b-%Y') as end_date,assessment_status,SUBSTRING_INDEX(trainer_email, '@', 1) AS 'trainer',
				case 
					when end_date<now() then 'Completed'
					when sc.start_date>now() then 'Enrolled'
					else 'In Progress'
				end as status
				FROM scheduled_courses sc
				INNER JOIN course_details cd ON
				sc.course_id = cd.course_id where sc.course_id in (select course_id from enrolled_courses where student_email='".$user."') and start_date in (select start_date from enrolled_courses where student_email='".$user."') ;";
	
	$result = mysqli_query($con,$query);
?>

<?php

		if(mysqli_num_rows($result)>0)
		{
			echo "<table style='border: 1px solid black; border-collapse: collapse; margin-top:20px'>";
			echo "<tr style='text-align: center; background-color: #000000; color: white;  font-size: 18px;'>";
			echo "<th style='border: 1px solid black;padding:10px'>Select</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Course Name</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Start date</th>";
			echo "<th style='border: 1px solid black;padding:10px'>End date</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Assessment</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Trainer</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Status</th>";
			echo "</tr>";
			while($row=mysqli_fetch_array($result))
			{
				$cname=$row['course_name'];
				$date=$row['start_date'];
				echo "<tr style='text-align: center;border: 1px solid black; font-size:18px'>";
				if($row['status']=='Enrolled')
				{
				echo "<td style='border: 0;padding:10px' bgcolor=white>"?><input type="checkbox" name="cancel_enroll" value=<?php echo "'$date,$cname'"; ?>><?php echo "</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['course_name']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['start_date']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['end_date']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['assessment_status']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['trainer']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['status']."</td>";
				echo "</tr>";
				}
				else
				{
				echo "<td style='border: 0;padding:10px' bgcolor=white>"?><?php echo "</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['course_name']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['start_date']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['end_date']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['assessment_status']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['trainer']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['status']."</td>";
				echo "</tr>";
					
				}
			}
			echo "</table>";
		}
		else
		{
			echo "<p style='color:#d11a2a; font-size: 25px;'> No courses enrolled ! </p>";
		}
	mysqli_close($con);
?>
<br>
<input type="submit" name="enroll_cancel" value="Cancel Enrollment" class="ec">
</form>
<br>
<div style='margin-left:18%'>
<?php require_once 'messages.php'; ?>
</div>

</body>
</html>
