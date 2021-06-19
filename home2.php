<?php   
session_start();
if(!isset($_SESSION["sess_user"]))
{  
    header("location:login.php");
}
else
{
	$con = mysqli_connect("localhost","siva","siva123","project");
$dropt="drop table courses;";
$ddt = mysqli_query($con,$dropt);
$con = mysqli_connect("localhost","siva","siva123","project");
$again="create table courses (select c.course_name,DATE_FORMAT(sc.start_date,'%d-%b-%Y') as start_date,DATE_FORMAT(sc.end_date,'%d-%b-%Y') as end_date,sc.assessment_status,substring_index(sc.trainer_email,'@',1) as trainer_email,sc.participant_limit from scheduled_courses sc inner join course_details c on sc.course_id=c.course_id);";
$r=mysqli_query($con,$again);	
}
?>
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
  <li><a class="active" href="home2.php">View Scheduled Courses</a></li>
  <li><a href="home3.php">View Enrolled Courses</a></li>
  <li><a href="home4.php">View Assessment Results</a></li>
</ul>
<h3>&ensp;&ensp;Scheduled courses</h3>
<form method="post" action="">
<?php
$con = mysqli_connect("localhost","siva","siva123","project");
	$query = "select distinct c.course_name from scheduled_courses sc inner join course_details c on sc.course_id=c.course_id;";
	$result = mysqli_query($con,$query);
?>
	<center>course name&nbsp;<select id="course" name="course" style='padding: 5px 10px'> 
	<option value="0">--Select--</option>
<?php
	while($row=mysqli_fetch_array($result))
	{
	 ?> 
	 <option value="<?php  echo $row['course_name'];?>"><?php  echo $row['course_name'];?></option>
<?php	
	}
?>
</select>
<?php
$query2 = "select distinct substring_index(sc.trainer_email,'@',1) as trainer from scheduled_courses sc inner join course_details c on sc.course_id=c.course_id;";
$result2 = mysqli_query($con,$query2);
?>
	Trainer name&nbsp;<select id="Trainer" name="trainer" style='padding: 5px 10px'> 
	<option value="0">--Select--</option>
<?php
	while($row=mysqli_fetch_array($result2))
	{
	 ?> 
	 <option value="<?php  echo $row['trainer'];?>"><?php  echo $row['trainer'];?></option>
<?php	
	}
?>
</select>
<?php
$query3 = "select distinct sc.assessment_status as assessment from scheduled_courses sc inner join course_details c on sc.course_id=c.course_id;";
$result3 = mysqli_query($con,$query3);
?>
	Assessment&nbsp;<select id="assessment" name="assessment" style='padding: 5px 10px'> 
	<option value="0">--Select--</option>
<?php
	while($row=mysqli_fetch_array($result3))
	{
	 ?> 
	 <option value="<?php  echo $row['assessment'];?>"><?php  echo $row['assessment'];?></option>
<?php	
	}
?>
</select>
<?php
$query4 = "select distinct DATE_FORMAT(start_date,'%D-%b-%Y') as date from scheduled_courses sc inner join course_details c on sc.course_id=c.course_id;";
$result4 = mysqli_query($con,$query4);
?>
	Start Date&nbsp;<select id="date" name="date" style='padding: 5px 10px'> 
	<option value="0">--Select--</option>
<?php
	while($row=mysqli_fetch_array($result4))
	{
	 ?> 
	 <option value="<?php  echo $row['date'];?>"><?php  echo $row['date'];?></option>
<?php	
	}
?>
</select></center>
<?php
if(!empty($_POST['submit']))
{
	$drop="drop table courses;";
	$dd = mysqli_query($con,$drop);
	$q="create table courses (
		select c.course_name,DATE_FORMAT(sc.start_date,'%d-%b-%Y') as start_date,DATE_FORMAT(sc.end_date,'%d-%b-%Y') as end_date,sc.assessment_status,substring_index(sc.trainer_email,'@',1) as trainer_email,sc.participant_limit from scheduled_courses sc inner join course_details c on sc.course_id=c.course_id
		);";
	$r = mysqli_query($con,$q);
	$s=$_POST['course'];
	$t=$_POST['trainer'];
	$a=$_POST['assessment'];
	$d=$_POST['date'];
	if (!empty($_POST['course']))
	{
		$con = mysqli_connect("localhost","siva","siva123","project");
		$qs="delete from courses where course_name<>'".$s."';";
		$r=mysqli_query($con,$qs);

	}
		if (!empty($_POST['trainer']))
	{
		$con = mysqli_connect("localhost","siva","siva123","project");
		$qs="delete from courses where trainer_email<>'".$t."';";
		$r=mysqli_query($con,$qs);

	}
		if (!empty($_POST['assessment']))
	{
		$con = mysqli_connect("localhost","siva","siva123","project");
		$qs="delete from courses where assessment_status<>'".$a."';";
		$r=mysqli_query($con,$qs);

	}
		if (!empty($_POST['date']))
	{
		$con = mysqli_connect("localhost","siva","siva123","project");
		$qs="delete from courses where start_date<>'".$d."';";
		$r=mysqli_query($con,$qs);

	}
}
?>
<br><br>
<div align=center margin-left=50%>
	<input type="submit" name="submit" value="Apply Filter" class="apply">
</div><br>
</form>
<form method="POST" action="p.php">
<center>
<?php
		$con = mysqli_connect("localhost","siva","siva123","project");
		$q="create table courses (
		select c.course_name,DATE_FORMAT(sc.start_date,'%d-%b-%Y') as start_date,DATE_FORMAT(sc.end_date,'%d-%b-%Y') as end_date,sc.assessment_status,substring_index(sc.trainer_email,'@',1) as trainer_email,sc.participant_limit from scheduled_courses sc inner join course_details c on sc.course_id=c.course_id
		);";
		$c=mysqli_query($con,$q);
		$sqlforall="select * from courses;";
		$resultall=mysqli_query($con,$sqlforall);
		if(mysqli_num_rows($resultall)>0)
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
			while($row=mysqli_fetch_array($resultall))
			{
				$cname=$row['course_name']; // getting values for course name
				$date=$row['start_date'];// getting values for course date 
				$end_date=$row['end_date'];
				$test=$row['assessment_status'];
				echo "<tr style='text-align: center;border: 1px solid black; font-size:18px'>";
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
<center margin-left=10%>
<?php require_once 'messages.php'; ?>
</center>

</body>
</html>
