<?php
include("connection.php");
$store=$_POST['store'];
$cat=$_POST['cat'];
$sqladd=mysqli_query($mysqli,"INSERT INTO store (store, category) VALUES ('$store', '$cat')");
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css?ver=1">
	</head>
	<body>
		<div style="height: 66%; width: 100%;">
			<div style="height: 100%;" class="flexcol">
				<p style="text-align: center;"><?php echo $store; ?> added</p>
				<a href="index.php"><button style="width: 100%;">Home</button></a>
			</div>
		</div>
	</body>
</html>
