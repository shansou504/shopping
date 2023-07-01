<!--SQL-->
<?php
include('connection.php');
$store = $_POST['store'];
$sqlselectedstore = mysqli_query($mysqli, "SELECT * FROM items WHERE store = '$store' AND (((DATE(NOW()) - dat) < 1) OR cart = 0) ORDER BY cart DESC, id ASC");
$sqldefcat = mysqli_query($mysqli, "SELECT * FROM store WHERE store = '$store'");
while ($rowdefcat = mysqli_fetch_assoc($sqldefcat)) {
$defcat = $rowdefcat['category'];
}
?>

<head>
<link rel="stylesheet" href="style.css?ver=1.3"/>
</head>
<body style="text-align: center;">

<!--HEADER-->
<div style="font-size: 60px; text-align: center;">
<?php
echo $store;
?>
</div>

<br>
<br>

<!--CHECKLIST HEADER-->
<div style="display: flex; flex-direction: row; align-items: center;">
<div style="width: 20%; font-size: 60px; text-align: center;">
Cart
</div>
<div style="width: 70%; font-size: 60px; text-align: center;">
Item
</div>
</div>

<br>

<!--CHECKLIST-->
<?php
while ($rowselectedstore = mysqli_fetch_assoc($sqlselectedstore)) {
echo "<form id='checklistform" . $rowselectedstore['item'] . "' action='checklist-update.php' method='post'>";
echo "<input type='hidden' name='id' value='" . $rowselectedstore['id'] . "'>";
echo "<input type='hidden' name='store' value='" . $rowselectedstore['store'] . "'>";
echo "<input type='hidden' name='dat' value='" . $rowselectedstore['dat'] . "'>";
echo "<div style='display: flex; flex-direction: row; align-items: center; font-size: 60px;'>";
echo "<div style='width: 20%; font-size: 60px; text-align: center;'>";
if ($rowselectedstore['cart'] == 0) {
echo "<input style='height: 60px; width: 60px; text-align: center;' type='checkbox' name='cart' unchecked onchange='subfun" . $rowselectedstore['id'] . "()'>";
} else {
echo "<input style='height: 60px; width: 60px; text-align: center;' type='checkbox' name='cart' checked onchange='subfun" . $rowselectedstore['id'] . "()'>";
}
echo "</div>";
echo "<div style='width: 70%;'>";
echo "<input style='font-size: 50px; width: 100%;' type='text' id='chkitemid" . $rowselectedstore['id'] . "' name='item' value='" . $rowselectedstore['item'] . "' onchange='subfun" . $rowselectedstore['id'] . "()' pattern='^[a-zA-Z0-9 ]+$' title='Letters or numbers only'>";
echo "</div>";
echo "</div>";
echo "<input type='hidden' name='category' value='" . $rowselectedstore['category'] . "'>";
echo "<input type='hidden' name='price' value='" . $rowselectedstore['price'] . "'>";
echo "</form>";
echo "<script>";
echo "function subfun" . $rowselectedstore['id'] . "() {";
echo "let form" . $rowselectedstore['id'] . " = document.getElementById('checklistform" . $rowselectedstore['item'] . "');";
echo "let a" . $rowselectedstore['id'] . " = form" . $rowselectedstore['id'] . ".chkitemid" . $rowselectedstore['id'] . ".value;";
echo "let chkpat" . $rowselectedstore['id'] . " = /^[a-zA-Z0-9 ]+$/;";
echo "let chkmat" . $rowselectedstore['id'] . " = a" . $rowselectedstore['id'] . ".match(chkpat" . $rowselectedstore['id'] . ");";
echo "if (a" . $rowselectedstore['id'] . " == '') {";
echo "}";
echo "else if (chkmat" . $rowselectedstore['id'] . " == null) {";
echo "alert('Item must contain letters or numbers only. Changes were not saved.')";
echo "} else {";
echo "form" . $rowselectedstore['id'] . ".submit();";
echo "};";
echo "};";
echo "</script>";
}
?>

<br>
<br>

<!--NEW ITEM-->
<form id="newitems" action="checklist-add.php" method="post">
<?php
echo "<input type='hidden' name='newstore' value='" . $store . "'>";
?>
<div style="display: flex; flex-direction: row; align-items: center;">
<div style="width: 20%;">
</div>
<div style="width: 70%;">
<input style="font-size: 45px; width: 100%;" type="text" id="newitemid" name="newitem" placeholder="New Item" autofocus onchange="subfun2()" pattern="^[a-zA-Z0-9 ]+$" title="Letters or numbers only">
</div>
</div>
<input type="hidden" name="newcategory" value="<?php echo $defcat;?>">
</form>

<!--RECORD RECEIPTS-->
<br>
<br>

<div style="display: flex; justify-content: center;">
<div style="width: 90%;">
<div style="display: flex; justify-content: center; align-items: center;">
<div style="width: 30%;">
<a href="index.php"><button style="width: 100%; font-size: 40px;">Home</button></a>
</div>
<div style="width: 5%;">
</div>
<div style="width: 30%;">
<a href="shoppinglist.php"><button style="width: 100%; font-size: 40px;">Shopping List</button></a>
</div>
<div style="width: 5%;">
</div>
<div style="width: 30%;">
<a href="receipts.php"><button style="width: 100%; font-size: 40px;">Record Receipts</button></a>
</div>
</div>
</div>
</div>

<br>
<br>

<!--UPDATE CHECKLIST-->
<script>
function subfun2() {
let form = document.getElementById("newitems");
let x = form.newitemid.value;
let pat = /^[a-zA-Z0-9 ]+$/;
let mat = x.match(pat);
if (x == "") {
} else if(mat == null) {
    alert("Item must contain letters or numbers only. Changes were not saved.");
} else {
    form.submit();
}
}
</script>

</body>
