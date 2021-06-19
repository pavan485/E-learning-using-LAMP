<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
    header("location:login.php");
} 
?> 
<html>
<head><link rel="stylesheet" href="home.css"></head>
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
<ul class="navList">
  <li><a class="active" href="home.php">Home&nbsp;&#127968;</a></li>
  <li><a href="home2.php">View Scheduled Courses</a></li>
  <li><a href="home3.php">View Enrolled Courses</a></li>
  <li><a href="home4.php">View Assessment Results</a></li>
</ul>
<h3>&ensp;&ensp;Upcoming courses</h3>
<form method="POST" action="enroll_home1.php">
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
				$cname=$row['course_name']; // getting values for course name
				$date=$row['start_date'];// getting values for course date 
				$end_date=$row['end_date'];
				$test=$row['assessment_status'];
				echo "<tr style='text-align: center; border: 1px solid black; font-size:18px';>";
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
		else
		{
			echo "<p style='color:#d11a2a; font-size: 25px;'> Upcoming trainings are not available ! </p>";
		}
	mysqli_close($con);
?>
</center><br>
<div align=center>
	<input type="submit" name="submit" value="Enroll Now" class="enrollnow">
</div><br>
</form>
<form method="post" name="ua" id="ua" action="assessment.php">
<h3>&ensp;&ensp;Upcoming Assessment</h3>
<center>
<?php
$user=$_SESSION["sess_user"];
$con=mysqli_connect("localhost","siva","siva123","project");
	if($con==false){
		die("ERROR: Could not connect. ". mysqli_connect_error());
	}
	
	$sql2="select distinct c.course_name,DATE_FORMAT(sc.start_date,'%d-%b-%Y') as start_date,DATE_FORMAT(date_add(end_date,interval 1 day),'%d-%b-%Y') as assessment_date,no_of_questions,no_of_questions*5 as marks,no_of_questions*2 as duration from scheduled_courses sc inner join course_details c on sc.course_id=c.course_id inner join enrolled_courses ec on c.course_id=ec.course_id WHERE sc.assessment_status='yes' and (sc.start_date in (select start_date from enrolled_courses where student_email='".$user."' and marks_secured is NULL)  and sc.course_id in (select course_id from enrolled_courses where student_email='".$user."'));";
	if($result2 = mysqli_query($con, $sql2))
	{
?>
<center>
<?php
		if(mysqli_num_rows($result2)>0){
			echo "<table style='border: 1px solid black; border-collapse: collapse;'>";
			echo "<tr style='text-align: center; background-color: #000000; color: white;  font-size: 18px;'>";
			echo "<th style='border: 1px solid black;padding:10px'Select</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Course Name</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Assessment Date</th>";
			echo "<th style='border: 1px solid black;padding:10px'>No of Quesions</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Total Marks</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Duration(in mins)</th>";
			echo "</tr>";
			while($row=mysqli_fetch_array($result2)){
				$coursename=$row['course_name'];
				$questions=$row['no_of_questions'];
				$start=$row['start_date'];
				echo "<tr style='text-align: center; border: 1px solid black; font-size:20px';>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>"?><input type="radio" name="r" value="<?php echo $coursename,",",$questions,",",$start ;?>"><?php echo "</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['course_name']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['assessment_date']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['no_of_questions']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['marks']."</td>";
				echo "<td style='border: 0;padding:10px' bgcolor=white>".$row['duration']."</td>";
				echo "</tr>";
			}
			echo "</table>";
			mysqli_free_result($result2);
		}else{
			echo "<p style='color:#d11a2a; font-size: 25px;'> No upcomming assessments ! </p>";
		}
	}else{
		echo "ERROR: Could not able to execute $sql. ". mysqli_error($con);
	}
	mysqli_close($con);
?>
<br>
</form>
<input type="submit" name="submit" value="Start Assessment" class="st"><br>
</center>
<div style='margin-left:22%;'>
<?php require_once 'messages.php'; ?>
</div>
</body>
</html>