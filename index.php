<?php
include("connection.php");
$sqlstore=mysqli_query($mysqli,"SELECT * FROM store ORDER BY store");
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css?ver=1.5">
	</head>
	<body onload="func()">
		<div style="height: 66%; width: 100%;">
			<div style="height: 100%;" class="flexcol">
				<form id="formid" name="form" action="store.php" method="post">
					<div class="flexcol">
						<select style="text-align: center;" required id="storeid" name="store" onchange="func()">
						<option selected disabled hidden value="none">Select a Store</option>
						<option value="new">-Add a Store-</option>
						<?php
						while($rowstore=mysqli_fetch_assoc($sqlstore)) {
							echo "<option value='" . $rowstore['store'] . "'>" . $rowstore['store'] . "</option>";
						}
						?>
						</select>
						<br>
						<button id="editid" name="edit" value="1">Add/Update Receipt</button>
						<br>
						<button id="searchid" name="search" value="1">Search for a Receipt</button>
					</div>
				</form>
				<a href="month.php"><button style="width: 100%;">Report</button></a>
			</div>
		</div>
	</body>
	<script>
		function func() {
			let x = document.getElementById('storeid').value;
			if(x=="none") {
				document.getElementById("editid").disabled = true;
				document.getElementById("searchid").disabled = true;
			} else if(x=="new") {
				location.href = "newstore.php";
			} else {
				document.getElementById("editid").disabled = false;
				document.getElementById("searchid").disabled = false;
			}
		}
	</script>
</html>
