<?php
include('connection.php');
$id = $_POST['id'];
$store = $_POST['store'];
$category = $_POST['category'];
$delete = $_POST['delete'];
if ($delete == "on") {
$slistdelete = mysqli_query($mysqli, "DELETE FROM store WHERE id = '$id'");
} else {
$slistupdate = mysqli_query($mysqli, "UPDATE store SET store = '$store', category = '$category' WHERE id = '$id'");
}
header('Location: storelist.php');
exit;
?>
