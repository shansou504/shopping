<!--SQL-->
<?php
include('connection.php');
$sqlreceipts = mysqli_query($mysqli, "SELECT * FROM receipts WHERE MONTH(NOW()) = MONTH(dat) ORDER BY dat ASC, store ASC, id ASC");
$storesavailable = "";
$sqlstore = mysqli_query($mysqli, "SELECT * FROM store ORDER BY store DESC");
while ($rowstore = mysqli_fetch_assoc($sqlstore)) {
$storesavailable = "<option value'" . $rowstore['store'] . "'>" . $rowstore['store'] . "</option>" . "\n" . $storesavailable;
}
$sqlcategory = mysqli_query($mysqli, "SELECT * FROM category ORDER BY category DESC");
$cats = "";
while ($rowcategory = mysqli_fetch_assoc($sqlcategory)) {
$cats = "<option value'" . $rowcategory['category'] . "'>" . $rowcategory['category'] . "</option>" . "\n" . $cats;
}
?>

<head>
<link rel="stylesheet" type="text/css" href="style.css?ver=1.3"/>
</head>
<body>

<!--HEADER-->
<div style="font-size: 60px; text-align: center;">
Record Receipts
</div>

<br>

<!--RECEIPTS HEADER-->
<div style="display: flex; justify-content: center; align-items: center;">
<div style="width: 95%;">
<div style="display: flex; justify-content: center; align-items: center;">
<div style="width: 20%; font-size: 30px; text-align: center;">
Store
</div>
<div style="width: 2%;">
</div>
<div style="width: 24%; font-size: 30px; text-align: center;">
Date
</div>
<div style="width: 2%;">
</div>
<div style="width: 20%; font-size: 30px; text-align: center;">
Category
</div>
<div style="width: 2%;">
</div>
<div style="width: 16%; font-size: 30px; text-align: center;">
Price
</div>
<div style="width: 14%; font-size: 30px; text-align: center;">
Delete
</div>
</div>
</div>
</div>

<!--RECEIPTS-->
<?php
while ($rowreceipts = mysqli_fetch_assoc($sqlreceipts)) {
echo "<form id='receiptform" . $rowreceipts['id'] . "' action='receipts-update.php' method='post'>";
echo "<input type='hidden' value='" . $rowreceipts['id'] . "' name='id'>";
echo "<div style='display: flex; justify-content: center; align-items: center;'>";
echo "<div style='width: 95%;'>";
echo "<div style='display: flex; justify-content: center; align-items: center;'>";
echo "<div style='width: 20%;'>";
echo "<select style='font-size: 30px; text-align: center; width: 100%;' name='store' id='storeid" . $rowreceipts['id'] . "' onchange='subfun" . $rowreceipts['id'] . "()'>";
echo "<option value='" . $rowreceipts['store'] . "' selected>" . $rowreceipts['store'] . "</option>";
echo $storesavailable;
echo "</select>";
echo "</div>";
echo "<div style='width: 2%;'>";
echo "</div>";
echo "<div style='width: 24%;'>";
echo "<div style='display: flex; justify-content: center;'>";
echo "<input style='font-size: 30px; text-align: center; width: 100%;' type='date' name='dat' value='" . $rowreceipts['dat'] . "' id='datid" . $rowreceipts['id'] . "' onchange='subfun" . $rowreceipts['id'] . "()'>";
echo "</div>";
echo "</div>";
echo "<div style='width: 2%;'>";
echo "</div>";
echo "<div style='width: 20%;'>";
echo "<select style='font-size: 30px; text-align: center; width: 100%;' name='category' onchange='subfun" . $rowreceipts['id'] . "()'>";
echo "<option value='" . $rowreceipts['category'] . "' selected>" . $rowreceipts['category'] . "</option>";
echo $cats;
echo "</select>";
echo "</div>";
echo "<div style='width: 2%;'>";
echo "</div>";
echo "<div style='width: 16%;'>";
echo "<input style='font-size: 30px; text-align: right; width: 100%;' type='number' name='price' min='0' max='10000' step='0.01' value='" . $rowreceipts['price'] . "' id='priceid" . $rowreceipts['id'] . "' onchange='subfun" . $rowreceipts['id'] . "()' pattern='^[0-9.]+$' title='Numbers and decimal only.'>";
echo "</div>";
echo "<div style='width: 14%; text-align: center;'>";
echo "<div style='display: flex; justify-content: center;'>";
echo "<input type='checkbox' style='height: 30px; width: 30px; text-align: center;' name='delete' onchange='subfun" . $rowreceipts['id'] . "()'>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</form>";
echo "<br>";
echo "<script>";
echo "function subfun" . $rowreceipts['id'] . "() {";
echo "let form" . $rowreceipts['id'] . " = document.getElementById('receiptform" . $rowreceipts['id'] . "');";
echo "let valprice" . $rowreceipts['id'] . " = form" . $rowreceipts['id'] . ".priceid" . $rowreceipts['id'] . ".value;";
echo "let pricepat" . $rowreceipts['id'] . " = /^[0-9.]+$/;";
echo "let pricemat" . $rowreceipts['id'] . " = valprice" . $rowreceipts['id'] . ".match(pricepat" . $rowreceipts['id'] . ");";
echo "if (pricemat" . $rowreceipts['id'] . " == null) {";
echo "alert('Price must contain only numbers or a decimal. Changes were not saved.');";
echo "} else {";
echo "form" . $rowreceipts['id'] . ".submit();";
echo "}";
echo "}";
echo "</script>";
}

echo "<form id='recaddform' action='receipts-add.php' method='post'>";
echo "<div style='display: flex; justify-content: center; align-items: center;'>";
echo "<div style='width: 95%;'>";
echo "<div style='display: flex; justify-content: center; align-items: center;'>";
echo "<div style='width: 20%;'>";
echo "<select style='width: 100%; font-size: 30px; text-align: center;' name='recaddstore'>";
echo "<option selected disabled> - Store - </option>";
echo $storesavailable;
echo "</select>";
echo "</div>";
echo "<div style='width: 2%;'>";
echo "</div>";
echo "<div style='width: 24%; text-align: center;'>";
echo "<input type='date' style='font-size: 30px; text-align: center; width: 100%;' value='" . date('Y-m-d') . "' name='recadddat'>";
echo "</div>";
echo "<div style='width: 2%;'>";
echo "</div>";
echo "<div style='width: 20%;'>";
echo "</div>";
echo "<div style='width: 2%;'>";
echo "</div>";
echo "<div style='width: 16%;'>";
echo "<input style='font-size: 30px; text-align: right; width: 100%;' type='number' name='recaddprice' min='0' max='10000' step='0.01' id='recaddpriceid' pattern='^[0-9.]+$' title='Numbers and decimal only.'>";
echo "</div>";
echo "<div style='width: 14%; text-align: center;'>";
echo "<button style='font-size: 30px; text-align: center;'>Add</button>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</form>";
?>


<br>
<br>

<div style="display: flex; justify-content: center;">
<div style="width: 90%;">
<div style="display: flex; justify-content: center; align-items: center;">
<div style="width: 5%;">
</div>
<div style="width: 40%;">
<a href="index.php"><button style="font-size: 55px; width: 100%;">Home</button></a>
</div>
<div style="width: 10%;">
</div>
<div style="width: 40%; text-align: center;">
<a href="shoppinglist.php"><button onload="scrolltobottom()" id="shoplink" style="font-size: 55px; width: 100%;">Shopping List</button></a>
</div>
<div style="width: 5%;">
</div>
</div>
</div>
</div>

<br>
<br>

<script>
const myTimeout = setTimeout(scrolltobottom, 250);
const element = document.getElementById("shoplink");
function scrolltobottom() {
	element.scrollIntoView(true);
}
</script>

</body>
