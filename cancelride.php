<?php 

include("action.php");

$obj = new connection();

$rideid = $_GET['id'];

$sql = $obj->cancelride($rideid);

$result = $sql;

if($sql)
{
	echo "<script> alert('Ride Canceled');</script>";
	header("location:pendingride.php");
}



?>