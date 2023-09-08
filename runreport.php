<?php
include("connection.php");
$monthid=$_POST['monthid'];
$sqlrpt=mysqli_query($mysqli,"SELECT b.cat, r.tot, b.amount FROM (SELECT cat cat, SUM(total) tot FROM rec WHERE MONTH(dat) = $monthid GROUP BY cat) r RIGHT JOIN budget b ON r.cat = b.cat ORDER BY b.cat");
$sqlrec=mysqli_query($mysqli, "SELECT SUM(total) s FROM rec WHERE MONTH(dat) = $monthid"); 
$sqlbud=mysqli_query($mysqli, "SELECT SUM(amount) s FROM budget"); 
$sqlcat=mysqli_query($mysqli, "SELECT * FROM category ORDER BY category");
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css?ver=1">
	</head>
	<body>
		<div class="flexcol">
			<p style="text-align: center; font-weight: bold;">
				<?php
					$month_name=date("F", mktime(0, 0, 0, $monthid, 10));
					echo $month_name;
				?>
			</p>
			<table id="tableid">
				<tr>
					<th style="text-align: left">Category</th>
					<th style="text-align: right">Total</th>
					<th style="text-align: right">Budget</th>
				</tr>
				<?php
					while($row=mysqli_fetch_assoc($sqlrpt)) {
						echo "<tr><td>" . $row['cat'] . "</td><td style='text-align: right'>" . $row['tot'] . "</td><td style='text-align: right'>" . $row['amount'] . "</td></tr>";
					}
					while($recsum=mysqli_fetch_assoc($sqlrec)) {
						echo "<tr><td style='font-weight: bold;'>Sum</td><td style='font-weight: bold; text-align: right;'>" . $recsum['s'] . "</td>";
					}
					while($budsum=mysqli_fetch_assoc($sqlbud)) {
						echo "<td style='font-weight: bold; text-align: right;'>" . $budsum['s'] . "</td></tr>";
					}
				?>
			</table>
			<br>
			<form action="catreport.php" method="post">
				<div class="flexcol">
					<input id="monthid" name="monthid" value="<?php echo $monthid; ?>" type="hidden">
					<input id="monthnameid" name="monthname" value="<?php echo $month_name; ?>" type="hidden">
					<select name="cat">
						<?php
							while($rowcat=mysqli_fetch_assoc($sqlcat)) {
								echo "<option value='" . $rowcat['category'] . "'>" . $rowcat['category'] . "</option>";
							}
						?>
					</select>
					<br>
					<button>Submit</button>
				</div>
			</form>
			<a href="index.php"><button style="width: 100%;">Home</button></a>
		</div>
	</body>
</html>
