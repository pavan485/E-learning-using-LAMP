<?php
$con = mysqli_connect("localhost","siva","siva123","project");
if (isset($_POST['submit1']) and isset($_POST['eid']))
{	
	$marks=0;
	$sql="select question_id,category,answer from question_bank;";
	$sql2="select count(question_id) as noofquestions from question_bank;";
	$result=mysqli_query($con, $sql);
	$result2=mysqli_query($con, $sql2);
	$co=mysqli_fetch_assoc($result2);
	$questioncount=$co['noofquestions'];
	//echo $questioncount;
			while($row=mysqli_fetch_assoc($result))
			{
				$qid=$row['question_id'];
				$c=$row['category'];
				$answer=$row['answer'];
				if(!empty($_POST[$qid]))
				{
					if($c=="single")
					{
					//echo $_POST[$qid];
					if($_POST[$qid]==$answer)
					{
						$marks++;
					}
						
				}
				else
				{		
						$cr=$_POST[$qid];
						$e=explode("~",$answer);
						if($cr==$e)
						{
							$marks++;
						}
				}
				}

			}	
}
$e=$_POST['eid'];
$tmarks=$marks*5;
$con = mysqli_connect("localhost","siva","siva123","project");
$u="update enrolled_courses set marks_secured='".$tmarks."' where enrollment_id='".$e."';";
$ru=mysqli_query($con, $u);
$percentage=round(($marks/$questioncount)*100);
if($percentage>=65)
{	
	header("Location:congratulation.php?percentage=".$percentage);
	exit();
}
else
{
	$con = mysqli_connect("localhost","siva","siva123","project");
	$enrollagain="select course_name from course_details where course_id in (select course_id from enrolled_courses where enrollment_id='".$e."');";
	$ea=mysqli_query($con, $enrollagain);
	$row=mysqli_fetch_array($ea);
	$p=$percentage."-".$row['course_name'];
	header("Location:failed.php?percentage=".$p);
	exit();
}
?>

