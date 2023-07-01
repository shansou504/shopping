<?php
include('connection.php');
$store = $_POST['recaddstore'];
$dat = $_POST['recadddat'];
$sqlcat = mysqli_query($mysqli, "SELECT * FROM store WHERE store = '$store'");
while ($rowcat = mysqli_fetch_assoc($sqlcat)) {
	$category = $rowcat['category'];
}
$price = $_POST['recaddprice'];
$sqlrecadd = mysqli_query($mysqli, "INSERT INTO receipts (id, store, dat, category, price) VALUES (NULL, '$store', '$dat', '$category', '$price')");
?>
<meta http-equiv="Refresh" content="0; url='receipts.php'" />