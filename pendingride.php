<?php
include("admin.php");

include("action.php");

?>

<div id="adminhome">

	<div>
		<p style="text-align: center;font-size: 50px;margin-bottom: 20px;color:white;">PENDING RIDE</p>

		<input class="w3-input w3-border w3-padding" type="text" placeholder="Filter by Date (YYYY-MM-DD) / Filter by Time" id="myInputDate" onkeyup="myFunctionDate()" style="width: 25%; margin-left: 1%">

		<input class="w3-input w3-border w3-padding" type="text" placeholder="Filter by Cab" id="myInputCab" onkeyup="myFunctionCab()" style="width: 25%; margin-left: 2%">
	</div>

	<hr />

<div id="adminhome">
	<table id="admintable" cellspacing="10">
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


			<th onclick="sortTable(4)">
				Cab Type &#x21c5;
			</th>


			<th>
				Total Distance
			</th>


			<th onclick="sortTable(6)">
				Total Cost &#x21c5;
			</th>


			<th>
				Luggage
			</th>

			<th>
				Customer Name
			</th>

			<th>
				Action
			</th>
		</tr>

		<?php

		$obj = new connection();

		$sql = $obj->pendingride();

		$result = $sql;

		if ($result->num_rows > 0) {
			// output data of each row
			while ($row = $result->fetch_assoc()) {
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
						&#x20B9;<?php echo $row['total_cost']; ?>
					</td>

					<td class="rideop">
						<?php echo $row['luggage']; ?>
					</td>

					<td>
						<?php echo $row['customer_user_name']; ?>
					</td>

					<td>
						<a href="cride.php?id=<?php echo $row['ride_id']; ?>" style="float: left">Allow</a>
						<a href="cancelride.php?id=<?php echo $row['ride_id'];?>">Cancel</a>
						<a href="deletependingride.php?id=<?php echo $row['ride_id'];?>" class="deny" style="float:right;">Delete</a>
					</td>

					<!-- <td>
				<input type="hidden" name="userid" value="<?php echo $row['user_id']; ?>">
			</td> -->
				<?php
			}
		} else {
				?>
				<td colspan="10">
					<?php echo "No Pending Ride is available"; ?>
				</td>
				</tr>
	</table>
</div>
<?php
		}

?>

</div>


<script type="text/javascript">
	//Filter By Date
	function myFunctionDate() {
		var input, filter, table, tr, td, i;
		input = document.getElementById("myInputDate");
		filter = input.value.toUpperCase();
		table = document.getElementById("admintable");
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
		table = document.getElementById("admintable");
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
		table = document.getElementById("admintable");
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
</script>
