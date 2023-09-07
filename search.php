<?php
include('connection.php');
$id=$_POST['id'];
$store=$_POST['store'];
$sql=mysqli_query($mysqli, "SELECT * FROM rec WHERE id = '$id'");
$sqlcat=mysqli_query($mysqli, "SELECT * FROM category ORDER BY category ASC");
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>
		<form id="formid" name="form" action="update.php" method="post">
			<label for="divid"><?php echo $store; ?></label>
			<div id="divid" class="flexcol">
				<?php
					while($row=mysqli_fetch_assoc($sql)) {
						echo "<input id='id' name='id' type='hidden' value='" . $row['id'] . "'>";
						echo "<input id='storeid' name='store' type='hidden' value='" . $row['store'] . "'>";
						echo "<input id='datid' name='dat' type='date' value='" . $row['dat'] . "'>";
						echo "<label for='itemsid'>Items</label>";
						echo "<textarea id='itemsid' form='formid' name='items' rows=2 value='" . $row['items'] . "'>" . $row['items'] . "</textarea>";
						echo "<label for='notesid'>Notes</label>";
						echo "<textarea id='noteid' form='formid' name='note' rows=2 value='" . $row['note'] . "'>" . $row['note'] . "</textarea>";
						echo "<label for='catid'>Catetory</label>";
						echo "<select id='catid' name='cat'>";
						echo "<option selected hidden value='" . $row['cat'] . "'>" . $row['cat'] . "</option>";
						while($rowcat=mysqli_fetch_assoc($sqlcat)) {
							echo "<option value='" . $rowcat['category'] . "'>" . $rowcat['category'] . "</option>";
						}
						echo "</select>";
						echo "<label for='totalid'>Total</label>";
						echo "<input id='totalid' name='total' type='number' step='0.01' value='" . $row['total'] . "'>";
						if($row['closed']) {
							echo "<input id='closedid' name='closed' type='hidden' value='1'>";
						}
					}
				?>
				<br>
				<button name="search" value="1">Update</button>
			</div>
		</form>
		<a href="index.php"><button style="width: 100%">Home</button></a>
	</body>
</html>
