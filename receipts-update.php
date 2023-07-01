<!--SQL-->
<?php
include('connection.php');
$id = $_POST['id'];
$store = $_POST['store'];
$dat = $_POST['dat'];
$category = $_POST['category'];
$price = $_POST['price'];
$delete = $_POST['delete'];
if ($delete == "on") {
$itemsdelete = mysqli_query($mysqli, "DELETE FROM receipts WHERE id = '$id'");
} else {
$itemsupdate = mysqli_query($mysqli, "UPDATE receipts SET store = '$store', dat = '$dat', category = '$category', price = '$price' WHERE id = '$id'");
}
?>
<meta http-equiv="Refresh" content="0; url='receipts.php'" />