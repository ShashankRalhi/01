<?php 

include("action.php");

$obj = new connection();

$rideid = $_GET['id'];

$sql = $obj->cancelride($rideid);

$result = $sql;

if($sql)
{
	//echo "<script> alert('Ride Canceled')window.location=;</script>";
	//header("location:userpendingride.php");

    echo "<script>alert('This Ride is Canceled')
            window.location='userpendingride.php';
            </script>";
}



?>