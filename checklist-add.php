<!--SQL-->
<?php
include('connection.php');
$dat = date("Y-m-d");
$store = $_POST['newstore'];
$cart = 0;
$item = $_POST['newitem'];
$category = $_POST['newcategory'];
$price = 0;
$itemsentry = mysqli_query($mysqli, "INSERT INTO items (id, store, dat, cart, item, category, price) VALUES (NULL, '$store', '$dat', '$cart', '$item', '$category', '$price')");
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