<?php
include('connection.php');
$store=$_POST['store'];
$edit=$_POST['edit'];
$search=$_POST['search'];
$closed=1;
if($edit) {
	$sqlclosed=mysqli_query($mysqli, "
		SELECT closed 
		FROM rec 
		WHERE store = '$store' 
		ORDER BY id DESC LIMIT 1
	");
	while($close=mysqli_fetch_assoc($sqlclosed)) {
		$closed=$close['closed'];
	}
	if($closed) {
		$sqldefcat=mysqli_query($mysqli, "
			SELECT * 
			FROM store 
			WHERE store = '$store' 
			ORDER BY id DESC LIMIT 1
		");
		while($defcat=mysqli_fetch_assoc($sqldefcat)) {
			$def=$defcat['category'];
		}
		$sqlins=mysqli_query($mysqli, "
			INSERT INTO rec (dat, store, items, note, cat, total, closed) 
			VALUES (NOW(), '$store', NULL, NULL, '$def', 0, 0)
		");
		echo "<html>";
		echo "<head>";
		echo "<link rel='stylesheet' type='text/css' href='style.css?ver=1.1'>";
		echo "</head>";
		echo "<body>";
		echo "<div style='height: 66%; width: 100%;'>";
		echo "<div style='height: 100%;' class='flexcol'>";
		echo "<p style='text-align: center;'>Receipt for " . $store . " created.</p>";
		echo "<form action='store.php' method='post'>";
		echo "<div class='flexcol'>";
		echo "<input name='store' type='hidden' value='" . $store . "'/>";
		echo "<button name='edit' value='1'>Back to " . $store . "</button>"; 
		echo "</div>";
		echo "</form>";
		echo "<a href='index.php'><button style='width: 100%'>Home</button></a>";
		echo "</div>";
		echo "</div>";
		echo "</body>";
		echo "</html>";
	} else {
		$sqlcat=mysqli_query($mysqli, "
			SELECT * 
			FROM category 
			ORDER BY category
		");
		echo "<html>";
		echo "<head>";
		echo "<link rel='stylesheet' type='text/css' href='style.css?ver=1.1'>";
		echo "</head>";
		echo "<body>";
		echo "<label for='formid'>$store</label>";
		echo "<form id='formid' name='form' action='update.php' method='post'>";
		echo "<div id='divid' class='flexcol'>";
		$sqlrec=mysqli_query($mysqli, "
			SELECT * 
			FROM rec 
			WHERE store = '$store' 
			ORDER BY id DESC LIMIT 1
		");
		while($row=mysqli_fetch_assoc($sqlrec)) {
			echo "<input id='id' name='id' type='hidden' value='" . $row['id'] . "'/>";
			echo "<input id='datid' name='dat' type='date' value='" . $row['dat'] . "'/>";
			echo "<input id='storeid' name='store' type='hidden' value='" . $row['store'] . "'/>";
			echo "<label for='itemsid'>Items</label>";
			echo "<textarea id='itemsid' name='items' form='formid' rows='2' value='" . $row['items'] . "'>" . $row['items'] . "</textarea>";
			echo "<label for='noteid'>Note</label>";
			echo "<textarea id='noteid' name='note' form='formid' rows='2' value='" . $row['note'] . "'>" . $row['note'] . "</textarea>";
			echo "<label for='catid'>Category</label>";
			echo "<select id='catid' name='cat'>";
			echo "<option selected value='" . $row['cat'] . "'>" . $row['cat'] . "</option>";
			while($rowcat=mysqli_fetch_assoc($sqlcat)) {
				echo "<option value='" . $rowcat['category'] . "'>" . $rowcat['category'] . "</option>";
			}
			echo "</select>";
			echo "<label for='totalid'>Total</label>";
			echo "<input id='totalid' name='total' type='number' step='0.01' value='" . $row['total'] . "'/>";
		}
		echo "<label><br>Closed&ensp;<input id='closedid' name='closed' type='checkbox' unchecked value='1'/><br><br></label>";
		echo "<button id='buttonid' name='button'>Update</button>";
		echo "</div>";
		echo "</form>";
		echo "<a href='index.php'><button style='width: 100%'>Home</button></a>";
		echo "</body>";
		echo "</html>";
	}
} else {
	?>
		<html>
			<head>
				<link rel='stylesheet' type='text/css' href='style.css?ver=1.1'>
			</head>
			<body onload="func()">
				<form action="search.php" method="post">
					<div style="height: 66%; align-items: center;" class="flexrow">
						<input name="store" type="hidden" value="<?php echo $store; ?>">
						<div style="width: 50%; height: 100%; padding: 2.5%;" class="flexcol">
							<select id="searchid" name="id" onchange="func()">
								<option disabled hidden selected value="none">ID Date Items</option>
								<?php
									$sql=mysqli_query($mysqli, "SELECT * FROM rec WHERE store = '$store' ORDER BY dat DESC");
									while($row=mysqli_fetch_assoc($sql)) {
										echo "<option value='" . $row['id'] . "'>" . $row['id'] . "&ensp;" . $row['dat'] . "&ensp;" . $row['items'] . "</option>";
									}
								?>
							</select>
						</div>
						<div style="width: 50%; height: 100%; padding: 2.5%;" class="flexcol">
							<button id="searchbtn">Select</button>
						</div>
					</div>
				</form>
			</body>
			<script>
				function func() {
					let x = document.getElementById("searchid").value;
					if(x=="none") {
						document.getElementById("searchbtn").disabled = true;
					} else {
						document.getElementById("searchbtn").disabled = false;
					}
				}
			</script>
		</html>
	<?php
}
?>

