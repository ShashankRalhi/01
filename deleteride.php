<?php 
include("action.php");

$obj = new connection();

$rideid = $_GET['id'];
?>


<script type="text/javascript">
	
	$r = confirm("Do you really want to delete this user?");

	if($r == true)
	{
		<?php 
			$sql = $obj->deleteride($rideid);

			$result = $sql;

			if($sql)
			{
				echo 	"<script>alert('Ride Successfully Deleted')
                        		window.location='completeride.php';
            			</script>";			
			}
			else
			{
				echo 	"<script>alert('Sorry this process is canceled')
                        	window.location='completeride.php';
            			</script>";
			}

		?>
	}
</script>


