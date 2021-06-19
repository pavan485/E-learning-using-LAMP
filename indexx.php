<html>
<head>
	<head><link rel="stylesheet" href="firstpage.css"></head>
</head>

<body>
	<header>
		<h1>E-LEARNING</h1>
	</header>
	<div class="buttons">
		<form method="GET" action="">
			<table align="center">
				<tr> 
					<td colspan="3" align="center"> <h2>Login Here</h2> </td>
				</tr>
				<tr>
					<td class="td"> <input type="submit" name="submit" value="Student" id="Student" class="student" /> </td>
					<td class="td"> <input type="submit" name="submit" value="Trainer" id="Trainer" class="trainer" /> </td>
					<td class="td"> <input type="submit" name="submit" value="Admin" id="Admin" class="admin"/> </td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>


<?php
session_start();
if (isset ($_REQUEST['submit'])) {
	$_SESSION['role'] = $_REQUEST['submit'];
	header("Location:login.php");
}

?>