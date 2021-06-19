<html>
<head><link rel="stylesheet" href="register.css"></head>
<body>
<header><p><h1>E-LEARNING</h1><p></header>
	<div class="q1">
		<p><h1>Register</h1></p>
	</div>	
<div class="main">
	<div class="q2">
		<form method="POST" action="" >
			<label>Email</label>
			<input type="email" placeholder="Enter Email Id" name="student_email"><br><br>
			<label>Phone Number</label>
			<input type="tel" placeholder="Enter Phone Number" name="phone_number"><br><br>
			<label>Gender</label>
			<input type="radio" id="male" name="gender" value="male">
			<label for="male">Male</label>
			<input type="radio" id="female" name="gender" value="female">
			<label for="female">Female</label><br><br>
			<label>Date of Birth</label>
			<input type="date" name="date_of_birth" placeholder="mm/dd/yyy"><br><br>
			<label>Password</label>
			<input type="password" name="password1" placeholder="Enter Password"><br><br>
			<label>Confirm password</label>
			<input type="password" name="password2" placeholder="Confirm Password"><br><br>	
			<div style="margin:0px 100px">
			<input type="submit" value="Register" name="submit" class="register"> 
			<input type="reset" name="Reset" value="Reset" class="reset">
			<p>Already have an account? <a href="login.php">Login Here</a></p>
			</div>
		</form>
	</div>
</div>
</body>
</html>
<?php  
if(isset($_POST["submit"]))
	{  
		if(!empty($_POST['student_email']) && !empty($_POST['password1'])&& !empty($_POST['password2'])&& !empty($_POST['phone_number'])&& !empty($_POST['gender'])&& !empty($_POST['date_of_birth'])) 
			{
				$user=$_POST['student_email'];  
				$pass=$_POST['password1']; 
				$phone=$_POST['phone_number'];  
				$gender=$_POST['gender']; 
				$dob=$_POST['date_of_birth'];  
				if(email_validation("$user")) 
					{ 
						if(phone_number("$phone")) 
							{ 
								if (dob($dob))
									{
										if(password($pass)) 
											{
												if(($_POST['password1'])==($_POST['password2']))
													{
														$user=$_POST['student_email'];  
														$pass=$_POST['password1']; 
														$phone=$_POST['phone_number'];  
														$gender=$_POST['gender']; 
														$dob=$_POST['date_of_birth'];   						
														$con = mysqli_connect("localhost","siva","siva123","project");    
														$sql="select register_student('$user','$phone','$gender','$dob','$pass') as id"; 
														$result=mysqli_query($con,$sql);
														$row=mysqli_fetch_assoc($result);
														$r=$row['id'	];
														if($r==0)
															{  
																	echo "<center>"."Account Successfully Created"."</center>";  
															} 
														elseif($r==1)
															{  
	
																echo "<center>"."That username already exists! Please try again with another."."</center>";  
																		
															}  
														else 
															{ 
																		echo "<center>"."Failure!"."</center>"; 
															} 
													}
												else
													{
														echo "<center>"."password and confirm password not matched"."</center>";
													}
											}	
										else
											{
												echo "<center>"."Password should contain uppercase,lowercase,number and special character"."</center>";
											}
									}
								else
									{
										echo "<center>"."Age is less than 15"."</center>";
									} 
							}
						else
							{
								echo "<center>"."Invalid phone number"."</center>";
							}
					} 
				else 
					{ 
						echo"<center>"."Invalid email address."."</center>"; 
					}
			}	
		else 
			{  
				echo "<center>"."All fields are required!"."</center>";  
			}  
	}  


function email_validation($user) { 
	return (!preg_match( 
"/^[a-zA-Z0-9]+(\.[._a-z0-9-]+)*(\@[a-z0-9-]{2,6})+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $user)) 
		? FALSE : TRUE; 
}
function phone_number($phone) { 
	return (preg_match("/^[1-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone)) 
		? FALSE : TRUE; 
} 
function password($pass){
$uppercase = preg_match('@[A-Z]@', $pass);
$lowercase = preg_match('@[a-z]@', $pass);
$number    = preg_match('@[0-9]@', $pass);
$special = preg_match('@[\\!\\@\\#\\$\\%\\^\\&\\*]@', $pass);
if($uppercase || $lowercase && $number && (strlen($pass) < 18 && strlen($pass)>4)) 
	{
	    return TRUE;
	}
else
	{
		return FALSE;
	}
}
function dob($dob){
	$bday = new DateTime($dob); // Your date of birth
	$today = new Datetime(date('m.d.y'));
	$diff = $today->diff($bday);
	if ($bday<$today && $diff->y>15)
		{
			return TRUE;
		}
	else
		{
			return FALSE;
	    }
}
?>