<?php
include("connection.php");
$monthid=$_POST['monthid'];
$month_name=$_POST['monthname'];
$cat=$_POST['cat'];
$sqlcatrpt=mysqli_query($mysqli,"SELECT * FROM rec WHERE MONTH(dat) = $monthid AND cat = '$cat' ORDER BY store, dat");
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css?ver=1">
	</head>
	<body>
		<div class="flexcol">
			<p style="text-align: center; font-weight: bold;">
				<?php
					echo $cat . " - " . $month_name;
				?>
			</p>
			<table id="tableid">
				<tr>
					<th style="text-align: left">Store</th>
					<th style="text-align: left">Date</th>
					<th style="text-align: left">Items</th>
					<th style="text-align: left">Notes</th>
					<th style="text-align: right">Total</th>
				</tr>
				<?php
					while($row=mysqli_fetch_assoc($sqlcatrpt)) {
						echo "
							<tr>
								<td style='text-align: left'>" . $row['store'] . "</td>
								<td style='text-align: left'>" . $row['dat'] . "</td>
								<td style='text-align: left'>" . $row['items'] . "</td>
								<td style='text-align: left'>" . $row['notes'] . "</td>
								<td style='text-align: right'>" . $row['total'] . "</td>
							</tr>
						";
					}
				?>
			</table>
			<br>
			<a href="index.php"><button style="width: 100%;">Home</button></a>
		</div>
	</body>
</html>
