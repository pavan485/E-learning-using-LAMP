<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
    header("location:login.php");
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
  <li><a href="home2.php">View Scheduled Courses</a></li>
  <li><a href="home3.php">View Enrolled Courses</a></li>
  <li><a class="active" href="home4.php">View Assessment Results</a></li>
</ul>
<h3>&ensp;&ensp;Assessment Results</h3>
<center>
<?php
	$user=$_SESSION["sess_user"];
	$con = mysqli_connect("localhost","siva","siva123","project");
	$query = "select c.course_name,DATE_FORMAT(assessment_date,'%d-%b-%Y') as assessment_date,floor((marks_secured/55)*100) as percentage,	
	case
    when floor((marks_secured/55)*100)>=90 then 'A'
    when floor((marks_secured/55)*100) between 85 and 89 then 'B'
    when floor((marks_secured/55)*100) between 70 and 84 then 'C'
    when floor((marks_secured/55)*100) between 65 and 69 then 'D'
    else 'E'
    end as grade from enrolled_courses ec inner join course_details c on ec.course_id=c.course_id where marks_secured is not null and ec.student_email='".$user."';";
	$result = mysqli_query($con,$query);
		if(mysqli_num_rows($result)>0)
		{
			echo "<table style='border: 1px solid black; border-collapse: collapse;'>";
			echo "<tr style='text-align: center; background-color: #000000; color: white;  font-size: 20px;'>";
			echo "<th style='border: 1px solid black;padding:10px'>Course Name</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Assessment Date</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Percentage</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Grade</th>";
			echo "<th style='border: 1px solid black;padding:10px'>Remark</th>";
			echo "</tr>";
			while($row=mysqli_fetch_array($result))
			{
				$p=$row['percentage'];
				if($p>65)
				{
					$d="Cleared";
				echo "<tr style='text-align: center; border: 1px solid black; font-size:18px';>";
				echo "<td style='border: 0;padding:10px' bgcolor=white><p style='color:Green'>".$row['course_name']."</td></p>";
				echo "<td style='border: 0;padding:10px' bgcolor=white><p style='color:Green'>".$row['assessment_date']."</td></p>";
				echo "<td style='border: 0;padding:10px' bgcolor=white><p style='color:Green'>".$row['percentage']."</td></p>";
				echo "<td style='border: 0;padding:10px' bgcolor=white><p style='color:Green'>".$row['grade']."</td></p>";
				echo "<td style='border: 0;padding:10px' bgcolor=white><p style='color:Green'>".$d."</td></p>";
				echo "</tr>";
				}
				else
				{
					$d="Not cleared";
				echo "<tr style='text-align: center; border: 1px solid black; font-size:18px';>";
				echo "<td style='border: 0;padding:10px' bgcolor=white><p style='color:Red'>".$row['course_name']."</td></p>";
				echo "<td style='border: 0;padding:10px' bgcolor=white><p style='color:Red'>".$row['assessment_date']."</td></p>";
				echo "<td style='border: 0;padding:10px' bgcolor=white><p style='color:Red'>".$row['percentage']."</td></p>";
				echo "<td style='border: 0;padding:10px' bgcolor=white><p style='color:Red'>".$row['grade']."</td></p>";
				echo "<td style='border: 0;padding:10px' bgcolor=white><p style='color:Red'>".$d."</td></p>";

				}
			}
			echo "</table>";
			mysqli_free_result($result);
		}
		else
		{
			echo "<center><p style='color:#d11a2a; font-size: 25px;' > NO assessment taken </p></center>";
		}
	mysqli_close($con);
?>
</center><br>

</body>
</html>
