<!doctype html>  
<html>
<head><link rel="stylesheet" href="login.css"></head>
<body>
<header><p><h1>E-LEARNING</h1><p></header>

	<div class="q1">
		<p><h1>Login</h1></p>
	</div>
	<div class="q2">
		<form method="POST" action="login.php" >
			<label>Email</label>
			<input type="email" placeholder="Enter Email Id" name="student_email"><br><br>
			<label>Password</label>
			<input type="password" placeholder="Enter Password" name="pass" ><br><br>
			<div class="q4">
				<input type="submit" value="Login &#10097;" name="submit" class="login" />
				<input type="reset" name="Reset" value="Reset &#10150" class="reset">
			</div>
			<div class="q3">
				<p>Don't have an account? <a href="register.php">Register Here</a></p>
			</div>
		</form>	
	</div>
</body>
</html> 
<?php  
if(isset($_POST["submit"]))
	{
		if(!empty($_POST['student_email']) && !empty($_POST['pass'])) 
			{  
				$user=strtolower($_POST['student_email']);  
				$pass=$_POST['pass'];
				$con = mysqli_connect("localhost","siva","siva123","project");  
				$q="SELECT student_email,password FROM student_details WHERE student_email='".$user."' AND password='".$pass."'";
				$query=mysqli_query($con,$q);  
				$numrows=mysqli_num_rows($query);  
				if($numrows!=0)  
					{  
						while($row=mysqli_fetch_assoc($query))  
							{  
								$dbusername=$row['student_email'];  
								$dbpassword=$row['password'];  
							}  
							if($user == strtolower($dbusername) && $pass == $dbpassword)  
								{  
									session_start();  
									$_SESSION['sess_user']=$user; 
									header("Location: home.php");  
								}
					} 
				else
					{
						$useremail=strtolower($_POST['student_email']);
						$con = mysqli_connect("localhost","siva","siva123","project");  
						$qe="SELECT student_email FROM student_details WHERE student_email='".$useremail."'";
						$queryemail=mysqli_query($con,$qe);  
						$numrowsemail=mysqli_num_rows($queryemail);  
						if($numrowsemail!=0)
						{ 
							while($row=mysqli_fetch_assoc($queryemail))  
								{  
									$dbusernameemail=$row['student_email'];    
								}  
								if($useremail == strtolower($dbusernameemail))
									{
										echo '<div class="ip">'."password incorrect".'</div>';
									}
						}
						else
							{
								echo '<div class="ip">'."Email Id entered is not registered with us.Kindly register".'</div>';
							}
					}  
  
			} 
		else 
			{  
				echo '<div class="fq">'."Please fill all the fields!".'</div>';  
			}  
	}
?>  
</body>  
</html>