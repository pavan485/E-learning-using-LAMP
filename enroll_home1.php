<?php
	if(isset($_POST["submit"]))
	{
		$con = mysqli_connect("localhost","siva","siva123","project");
		session_start();
		$user_name=$_SESSION['sess_user'];
		echo "$user_name";
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
		//$q2= "SELECT @output;";
		$result=mysqli_query($con,$q);
		$result2=mysqli_query($con,'SELECT @output');
		$r = mysqli_fetch_assoc($result2);
		$p = $r['@output'];
		$_SESSION['messages'][]=$p;
		header('location:home.php');
		exit;
		}
		
	}
	
?>
