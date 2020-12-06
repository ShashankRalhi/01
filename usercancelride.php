<?php
session_start();

if(isset($_SESSION['username']))
{


if ($_SESSION['username'] != "ADMIN") {

	include("customer-dashboard.php");

	include("action.php");

	$obj = new connection();

	$username = $_SESSION['username'];

?>

	<div>

		<h1 style="text-align: center;margin-bottom: 2%; text-transform: uppercase;margin-left: 15%"><?php echo $_SESSION['username']; ?>'s Canceled Ride</h1>
		<hr />
		<table id="userridetable" cellspacing="10">

			<tr>

				<th>
					Ride Id
				</th>

				<th onclick="sortTable(1)">
					Ride Date &#x21c5;
				</th>

				<th>
					Pickup Point
				</th>

				<th>
					Drop Point
				</th>


				<th>
					Cab Type
				</th>


				<th>
					Total Distance
				</th>

				<th>
					Luggage
				</th>

				<th onclick="sortnum(6)">
					Total Cost &#x21c5;
				</th>

			</tr>

			<?php

			$sql = $obj->usercancelride($username);

			if ($sql->num_rows > 0) {
				// output data of each row
				while ($row = $sql->fetch_assoc()) {
			?>

					<tr>

						<td>
							<?php echo $row['ride_id']; ?>
						</td>

						<td>
							<?php echo $row['ride_date']; ?>
						</td>

						<td>
							<?php echo $row['pickup_point']; ?>
						</td>

						<td>
							<?php echo $row['drop_point']; ?>
						</td>

						<td>
							<?php echo $row['cab_type']; ?>
						</td>

						<td>
							<?php echo $row['total_distance']; ?>
						</td>

						<td>
							<?php echo $row['luggage']; ?>
						</td>

						<td>
							&#x20B9;<?php echo $row['total_cost']; ?>
						</td>
				<?php
			}
				?>
			
				<?php
			}
			else 
			{
				?>
					<td colspan="10">
						<?php echo "No Ride is available"; ?>
					</td>
					</tr>
		</table>
	<?php
			}
	?>


	<script type="text/javascript">
		//Filter By Date
		function myFunctionDate() {
			var input, filter, table, tr, td, i;
			input = document.getElementById("myInputDate");
			filter = input.value.toUpperCase();
			table = document.getElementById("userridetable");
			tr = table.getElementsByTagName("tr");
			for (i = 1; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[1];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}


		//Filter By Cab 
		function myFunctionCab() {
			var input, filter, table, tr, td, i;
			input = document.getElementById("myInputCab");
			filter = input.value.toUpperCase();
			table = document.getElementById("userridetable");
			tr = table.getElementsByTagName("tr");
			for (i = 1; i < tr.length; i++) {
				td = tr[i].getElementsByTagName("td")[4];
				if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
				}
			}
		}



















		function sortTable(n) {
			var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
			table = document.getElementById("userridetable");
			switching = true;

			dir = "asc";

			while (switching) {

				switching = false;
				rows = table.rows;

				for (i = 1; i < (rows.length - 1); i++) {

					shouldSwitch = false;

					x = rows[i].getElementsByTagName("TD")[n];
					y = rows[i + 1].getElementsByTagName("TD")[n];

					if (dir == "asc") {
						if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {

							shouldSwitch = true;
							break;
						}
					} else if (dir == "desc") {
						if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {

							shouldSwitch = true;
							break;
						}
					}
				}
				if (shouldSwitch) {

					rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
					switching = true;

					switchcount++;
				} else {

					if (switchcount == 0 && dir == "asc") {
						dir = "desc";
						switching = true;
					}
				}
			}
		}










		function sortnum(n) {
			var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
			table = document.getElementById("userridetable");
			switching = true;

			dir = "asc";

			while (switching) {

				switching = false;
				rows = table.rows;

				for (i = 1; i < (rows.length - 1); i++) {

					shouldSwitch = false;

					x = rows[i].getElementsByTagName("TD")[n];
					y = rows[i + 1].getElementsByTagName("TD")[n];

					if (dir == "asc") {
						if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {

							shouldSwitch = true;
							break;
						}
					} else if (dir == "desc") {
						if (parseInt(x.innerHTML) < parseInt(y.innerHTML)) {

							shouldSwitch = true;
							break;
						}
					}
				}
				if (shouldSwitch) {

					rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
					switching = true;

					switchcount++;
				} else {

					if (switchcount == 0 && dir == "asc") {
						dir = "desc";
						switching = true;
					}
				}
			}
		}
	</script>


<?php
} else {
	echo "<script>
                alert('Don't Try to Access Customer Pannel);
            </script>";

	header("location:logout.php");
}

}
else

    echo "<script>alert('Please Login Again')
                window.location='login.php';
                </script>";
?>
