<!--SQL-->
<?php
include('connection.php');
$id = $_POST['id'];
$store = $_POST['store'];
$dat = $_POST['dat'];
$cart = $_POST['cart'];
if ($cart == "on") {
$cart = "1";
} else {
$cart = "0";
}
$item = $_POST['item'];
$category = $_POST['category'];
$price = $_POST['price'];
$delete = $_POST['delete'];
if ($delete == "on") {
$itemsdelete = mysqli_query($mysqli, "DELETE FROM items WHERE id = '$id'");
} else {
$itemsupdate = mysqli_query($mysqli, "UPDATE items SET store = '$store', dat = '$dat', cart = '$cart', item = '$item', category = '$category', price = '$price' WHERE id = '$id'");
}
?>
<meta http-equiv="Refresh" content="0; url='shoppinglist.php'" />
