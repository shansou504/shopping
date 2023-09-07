<?php
include("connection.php");
$sqlcategory=mysqli_query($mysqli,"SELECT * FROM category ORDER BY category");
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css?ver=1">
	</head>
	<body>
		<form action="addstore.php" method="post">
			<div style="height: 66%; width: 100%;">
				<div style="height: 100%;" class="flexcol">
					<label for="storeid">Store</label>
					<input id="storeid" name="store" type="text" required>
					<label for="catid">Category</label>
					<select id="catid" name="cat">
						<?php
							while($rowcat=mysqli_fetch_assoc($sqlcategory)) {
								echo "<option value='" . $rowcat['category'] . "'>" . $rowcat['category'] . "</option>";
							}
						?>
					</select>
					<br>
					<button>Add</button>
				</div>
			</div>
		</form>
	</body>
</html>
