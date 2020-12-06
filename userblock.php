<?php 

include('action.php');

$id = $_GET['id'];

$obj = new connection();

$sql = $obj->block($id);

if($sql)
{
	echo "<script>alert('This user is blocked')
                        window.location='approved-request.php';
                        </script>";
}
else
{
	
	echo "<script>alert('This user is not blocked')
                        window.location='approved-request.php';
                        </script>";
}




?>