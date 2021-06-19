<?php   
session_start();  
if(!isset($_SESSION["sess_user"])){  
    header("location:login.php");  
} 
?>
<?php
if(isset($_POST["submit"]))
{
	$select=$_POST['r'];
	$str_arr = explode (",",$select);
	$name=$str_arr[0];
	$number=(int)$str_arr[1];
	$date=$str_arr[2];
	$number2=$number*5;
}
?>
<!DOCTYPE html>
<html>
<head>
	<script type="text/javascript">
	function timeout()
	{
		var minute=Math.floor(timeLeft/60);
		var second=timeLeft%60;
		var mint=checktime(minute);
		var sec=checktime(second);
		if(timeLeft<=55)
		{
			clearTimeout(tm);
			document.getElementById("form1").submit();
		}
		else
		{

			document.getElementById("time").innerHTML=mint+":"+sec;
		}
		timeLeft--;
		var tm= setTimeout(function(){timeout()},1000);
	}
	function checktime(msg)
	{
		if(msg<10)
		{
			msg="0"+msg;
		}
		return msg;
	}
	</script>
<link rel="stylesheet" href="assessment.css"></head>
<body onload="timeout()" >
<header><h1> E-Learning   <span style="float: right; padding-right:25px; font-weight: bold; letter-spacing: 2px; font-size: 35px; padding-top:0.5px">
 Hi! <?=strstr($_SESSION['sess_user'],'@',true);?>
<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn">&#9776;</button>
	<div id="myDropdown" class="dropdown-content" style="font-size:15px; font-weight:bold;">
		<a href="logout.php">Logout</a>
	</div>
</div>
<?php
	$con = mysqli_connect("localhost","siva","siva123","project");
	$timequery="select count(question_id) as time from question_bank;";
	$result2=mysqli_query($con, $timequery);
	$timerow=mysqli_fetch_assoc($result2);
	$t1=(int)$timerow['time'];
	$m=5*$t1;
	$user=$_SESSION["sess_user"];
	$e="select enrollment_id from enrolled_courses where course_id in (select course_id from course_details where course_name='".$name."')and (DATE_FORMAT(start_date,'%d-%b-%Y')='".$date."' and student_email='".$user."');";
	$eresult=mysqli_query($con,$e);
	$re=mysqli_fetch_assoc($eresult);
	$eid=$re['enrollment_id'];
?>
<script type="text/javascript">
	var timeLeft=<?php echo $t1;?>*60;
</script>

<script type="text/javascript">
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
<div style="text-align:center" class="line">
    <span style="float:left" position="fixed">Course Name:<?php echo $name; ?></span>
    <span style="float:right" position="fixed"  id="time" >time</span>
    <span position="fixed">Total Marks:<?php echo $number2; ?></span>
</div>
<form method="post"  id="form1" action="cal.php">
<?php
$con = mysqli_connect("localhost","siva","siva123","project");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
$sql="select * from question_bank";
	if($result = mysqli_query($con, $sql))
	{
		if(mysqli_num_rows($result)>0)
		{
			$sql2="select question_id,category from question_bank;";
			$result2=mysqli_query($con, $sql2);
			while($row=mysqli_fetch_assoc($result2))
			{
				$qid=$row['question_id'];
				$cat=$row['category'];
			if($cat=="single")
			{
				$getquestion="select * from question_bank where question_id='".$qid."'";
				$getqresult=mysqli_query($con,$getquestion);
				while($que=mysqli_fetch_array($getqresult))
				{
					echo "<br><div style='margin:0px 50px'>".substr($que['question_id'],3),")"."&ensp;";
					echo $que['question_description']."</div>";
					echo "<div style='margin:0px 90px'>".$que['code']."<br></div>";
					$c=explode("~",$que['options']);
					$char='A';
					foreach ($c as $v)
					{
?>
					<div style='margin:0px 90px'><?php echo $char; ?>&ensp;<input type="radio" name="<?php echo $que['question_id'] ?>" value="<?php echo $char;?>">&ensp;<?php echo $v; ?><br></div>
<?php
					++$char;
					}
				}
				$char='A';
				
			}
			else
			{
				$getquestion="select * from question_bank where question_id='".$qid."'";
				$getqresult=mysqli_query($con,$getquestion);
				while($que=mysqli_fetch_array($getqresult))
				{
					echo "<br><div style='margin:0px 50px'>".substr($que['question_id'],3),")"."&ensp;";
					echo $que['question_description']."</div>";
					echo "<div style='margin:0px 90px'>".$que['code']."</div><br>";
					$c=explode("~",$que['options']);
					$char='A';
					foreach ($c as $v)
					{
?>
					<div style='margin:0px 90px'><?php echo $char; ?>&ensp;<input type="checkbox" name="<?php echo $que['question_id'] ?>[]" value="<?php echo $char; ?>">&ensp;<?php echo $v; ?><br></div>
<?php				
					++$char;
					}
					
				}
				$char='A';
			}
			}
			mysqli_free_result($result2);
		}
	}
	mysqli_close($con);
?>
<input type="hidden" name="eid" value="<?php echo $eid;?>">
<center>
	<input type="submit" name="submit1" value="Finish Assessment" class="fa">
</center>
</form>	
</body>
</html>
