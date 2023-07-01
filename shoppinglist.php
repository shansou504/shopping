<!--SQL-->
<?php
include('connection.php');
//$sqlshoppinglist = mysqli_query($mysqli, "SELECT * FROM items WHERE (((DATE(NOW()) - dat) < 7) OR cart = 0) ORDER BY cart DESC, store ASC, dat ASC, item ASC");
$sqlshoppinglist = mysqli_query($mysqli, "SELECT * FROM items ORDER BY cart DESC, store ASC, dat ASC, item ASC");
$sqlstore = mysqli_query($mysqli, "SELECT * FROM store ORDER BY store DESC");
$storesavailable = "";
while ($rowstore = mysqli_fetch_assoc($sqlstore)) {
$storesavailable = "<option value'" . $rowstore['store'] . "'>" .  $rowstore['store'] . "</option>" . "\n" . $storesavailable;
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
Shopping List
</div>

<br>

<!--SHOPPINGLIST HEADER-->
<div style="display: flex; justify-content: center; align-items: center;">
<div style="width: 95%;">
<div style="display: flex; justify-content: center; align-items: center;">
<div style="width: 15%; font-size: 40px; text-align: center;">
Store
</div>
<div style="width: 2.5%;">
</div>
<div style="width: 25%; font-size: 40px; text-align: center;">
Date
</div>
<div style="width: 15%; font-size: 40px; text-align: center;">
Cart
</div>
<div style="width: 30%; font-size: 40px; text-align: center;">
Item
</div>
<div style="width: 2.5%;">
</div>
<div style="width: 10%; font-size: 40px; text-align: center;">
Delete
</div>
</div>
</div>
</div>

<!--SHOPPINGLIST-->
<?php
while ($rowshoppinglist = mysqli_fetch_assoc($sqlshoppinglist)) {
echo "<form id='shoppingform" . $rowshoppinglist['id'] . "' action='shoppinglist-update.php' method='post'>";
echo "<div style='display: flex; justify-content: center; align-items: center;'>";
echo "<div style='width: 95%;'>";
echo "<div style='display: flex; justify-content: center; align-items: center;'>";
echo "<input type='hidden' name='id' value='" . $rowshoppinglist['id'] . "'>";
echo "<div style='width: 15%;'>";
echo "<select style='font-size: 30px; width: 100%;' name='store' id='storeid" . $rowshoppinglist['id'] . "' onchange='subfun" . $rowshoppinglist['id'] . "()'>";
echo "<option value='" . $rowshoppinglist['store'] . "' selected>" . $rowshoppinglist['store'] . "</option>";
echo $storesavailable;
echo "</select>";
echo "</div>";
echo "<div style='width: 2.5%;'>";
echo "</div>";
echo "<div style='width: 25%;'>";
echo "<div style='display: flex; justify-content: center;'>";
echo "<input style='font-size: 30px; width: 100%;' type='date' name='dat' value='" . $rowshoppinglist['dat'] . "' id='datid" . $rowshoppinglist['id'] . "' onchange='subfun" . $rowshoppinglist['id'] . "()'>";
echo "</div>";
echo "</div>";
echo "<div style='width: 15%;'>";
echo "<div style='display: flex; justify-content: center;'>";
if ($rowshoppinglist['cart'] == 0) {
echo "<input type='checkbox' name='cart' style='height: 40px; width: 40px; text-align: center;' unchecked id='cartid" . $rowshoppinglist['id'] . "' onchange='subfun" . $rowshoppinglist['id'] . "()'>";
} else {
echo "<input type='checkbox' name='cart' style='height: 40px; width: 40px; text-align: center;' checked id='cartid" . $rowshoppinglist['id'] . "' onchange='subfun" . $rowshoppinglist['id'] . "()'>";
}
echo "</div>";
echo "</div>";
echo "<div style='width: 30%;'>";
echo "<input style='font-size: 30px; width: 100%;' type='text' name='item' id='itemid" . $rowshoppinglist['id'] . "' onchange='subfun" . $rowshoppinglist['id'] . "()' value='" . $rowshoppinglist['item'] . "' pattern='^[a-zA-Z0-9 ]+$' title='Letters or numbers only'>";
echo "</div>";
echo "<input type='hidden' name='category' value='" . $rowshoppinglist['category'] . "'>";
echo "<input type='hidden' name='price' value='" . $rowshoppinglist['price'] . "'>";
echo "<div style='width: 2.5%;'>";
echo "</div>";
echo "<div style='width: 10%;'>";
echo "<div style='display: flex; justify-content: center;'>";
echo "<input type='checkbox' style='height: 40px; width: 40px; text-align: center;' name='delete' id='deleteid" . $rowshoppinglist['id'] . "' onchange='subfun" . $rowshoppinglist['id'] . "()' onchange='subfun" . $rowshoppinglist['id'] . "()'>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
echo "</form>";
echo "<br>";
echo "<script>";
echo "function subfun" . $rowshoppinglist['id'] . "() {";
echo "let form" . $rowshoppinglist['id'] . " = document.getElementById('shoppingform" . $rowshoppinglist['id'] . "');";
echo "let valitem" . $rowshoppinglist['id'] . " = form" . $rowshoppinglist['id'] . ".itemid" . $rowshoppinglist['id'] . ".value;";
echo "let itempat" . $rowshoppinglist['id'] . " = /^[a-zA-Z0-9 ]+$/;";
echo "let itemmat" . $rowshoppinglist['id'] . " = valitem" . $rowshoppinglist['id'] . ".match(itempat" . $rowshoppinglist['id'] . ");";
echo "if (itemmat" . $rowshoppinglist['id'] . " == null) {";
echo "alert('Item must contain only letters or numbers. Changes were not saved.');";
echo "} else {";
echo "form" . $rowshoppinglist['id'] . ".submit();";
echo "}";
echo "}";
echo "</script>";
}
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
<a href="receipts.php"><button onload="scrolltobottom()" id="reclink" style="font-size: 55px; width: 100%;">Record Receipts</button></a>
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
const element = document.getElementById("reclink");
function scrolltobottom() {
	element.scrollIntoView(true);
}
</script>


</body>
