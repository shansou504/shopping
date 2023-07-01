<!--SQL-->
<?php
include('connection.php');
$id = $_POST['id'];
$store = $_POST['store'];
$dat = date("Y-m-d");
$cart = $_POST['cart'];
if ($cart == "on") {
$cart = "1";
} else {
$cart = "0";
}
$item = $_POST['item'];
$category = $_POST['category'];
$price = $_POST['price'];
$itemsupdate = mysqli_query($mysqli, "UPDATE items SET store = '$store', dat = '$dat', cart = '$cart', item = '$item', category = '$category', price = '$price' WHERE id = '$id'");
?>

<!--GO TO CHECKLIST-->
<form id="form" action="checklist.php" method="post">
<input type="hidden" name="store" value="<?php echo $store;?>" onchange="gotochecklist()">
</form>

<!--GO TO CHECKLIST AUTOMATICALLY-->
<script>
const myTimeout = setTimeout(gotochecklist, 250);
function gotochecklist() {
let form = document.getElementById("form");
form.submit();
}
</script>
