<?php

	if(isset($_POST))
	{
		$con = mysqli_connect("localhost","siva","siva123","project");
		session_start();
		$user_name=$_SESSION['sess_user'];
		$select=$_POST['cancel_enroll'];
		$str_arr=explode(",",$select);
		print_r($str_arr);
		$cname=$str_arr[1];
		$date=$str_arr[0];
		$q = "select course_id from course_details where course_name='".$cname."';";
		$result=mysqli_query($con,$q);
		while($row=mysqli_fetch_row($result))
		{
			$cid = $row[0];
		}
		if(mysqli_query($con,"delete from enrolled_courses where student_email='".$user_name."' and (course_id='".$cid."' and DATE_FORMAT(start_date,'%d-%b-%Y')='".$date."');"))
		{
			if(mysqli_query($con,"update scheduled_courses set participant_limit=participant_limit+1 where course_id='".$cid."' and start_date='".$date."';"))
			{
				$_SESSION['messages'][]='Successfully Canceled';
				header('location:home3.php');
				exit;
			}
		}

	}
?>