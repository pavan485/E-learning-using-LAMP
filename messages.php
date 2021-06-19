<?php
if(empty($_SESSION['messages']))
{
	return;
}
$messages = $_SESSION['messages'];
unset($_SESSION['messages']); 

?>
<ul style='height:35;font-size:20px;width:600;'>
	<?php foreach ($messages as $message): ?>
		<li><?php echo $message; ?></li>
	<?php endforeach; ?>
</ul>