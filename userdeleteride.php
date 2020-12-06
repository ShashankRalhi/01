<?php
session_start();

include("action.php");

$obj = new connection();

$rideid = $_GET['id'];

?>



<script>

	$r = confirm('Do you really want to delete this ride');

	if($r==true)
	{
		<?php 
			$sql = $obj->deleteride($rideid);
		?>
			location:'userpendingride.php';
	}
	else
	{
		alert('Ride is still in pending');
		<?php header('location:userpendingride.php'); ?>
	}

</script>