<!--SQL-->
<?php
include("connection.php");
$sqlstore = mysqli_query($mysqli, "SELECT * FROM store ORDER BY store ASC");
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

<br>

<!--EDIT STORES HEADER-->
<div style='display: flex; justify-content: center; align-items: center;'>
<div style='width: 95%;'>
<div style='display: flex; justify-content: center; align-items: center;'>
<div style='width: 50%; font-size: 55px; text-align: center;'>
Store
</div>
<div style='width: 5%;'>
</div>
<div style='width: 30%; font-size: 55px; text-align: center;'>
Category
</div>
<div style='width: 15%; font-size: 55px; text-align: center;'>
Delete
</div>
</div>
</div>
</div>

<!--EDIT STORES-->
<?php
while ($rowsqlstore = mysqli_fetch_assoc($sqlstore)) {
    echo "<form id='storeform" . $rowsqlstore['id'] . "' action='store-update.php' method='post'>";
    echo "<div style='display: flex; justify-content: center; align-items: center;'>";
    echo "<div style='width: 95%;'>";
    echo "<div style='display: flex; justify-content: center; align-items: center;'>";
    echo "<div style='width: 0%;'>";
    echo "<input type='hidden' name='id' value='" . $rowsqlstore['id'] . "'>";
    echo "</div>";
    echo "<div style='width: 50%;'>";
    echo "<input style='font-size: 35px; width: 100%;' type='text' name='store' id='storeid" . $rowsqlstore['id'] . "' value='" . $rowsqlstore['store'] . "' onchange='subfun" . $rowsqlstore['id'] . "()' pattern='^[a-zA-Z0-9 ]+$' title='Letters or numbers only'>";
    echo "</div>";
    echo "<div style='width: 5%;'>";
    echo "</div>";
    echo "<div style='width: 30%;'>";
    echo "<select style='font-size: 35px; width: 100%;' name='category' onchange='subfun" . $rowsqlstore['id'] . "()'>";
    echo "<option value='" . $rowsqlstore['category'] . "'>" . $rowsqlstore['category'] . "</option>";
    echo $cats;
    echo "</select>";
    echo "</div>";
    echo "<div style='width: 15%;'>";
    echo "<div style='display: flex; justify-content: center;'>";
    echo "<input type='checkbox' style='text-align: center; height: 50px; width: 50px;' unchecked name='delete' onchange='subfun" . $rowsqlstore['id'] . "()'>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</form>";
    echo "<br>";
    echo "<script>";
    echo "function subfun" . $rowsqlstore['id'] . "() {";
    echo "let form" . $rowsqlstore['id'] . " = document.getElementById('storeform" . $rowsqlstore['id'] . "');";
    echo "let storeval" . $rowsqlstore['id'] . " = storeform" . $rowsqlstore['id'] . ".storeid" . $rowsqlstore['id'] . ".value;";
    echo "let storepat" . $rowsqlstore['id'] . " = /^[a-zA-Z0-9 ]+$/;";
    echo "let storemat" . $rowsqlstore['id'] . " = storeval" . $rowsqlstore['id'] . ".match(storepat" . $rowsqlstore['id'] . ");";
    echo "if (storemat" . $rowsqlstore['id'] . " == null) {";
    echo "alert('Store must contain letters or numbers only. Changes were not saved.');";
    echo "} else {";
    echo "form" . $rowsqlstore['id'] . ".submit();";
    echo "}";
    echo "}";
    echo "</script>";
}
?>

<br>
<br>
<!--ADD NEW STORE-->
<form id="form2" action="store-add.php" method="post">
<div style="display: flex; justify-content: center; align-items: center;">
<div style="width: 95%;">
<div style="display: flex; justify-content: center; align-items: center;">
<div style="width: 50%;">
<div style="display: flex; justify-content: center; align-items: center;">
<input style="width: 100%; text-align: center; font-size: 35px;" type="text" name="addstore" placeholder=" - Add Store - " required pattern="^[a-zA-Z0-9 ]+$" title="Letters or numbers only">
</div>
</div>
<div style="width: 5%;">
</div>
<div style="width: 30%;">
<div style="display: flex; justify-content: center; align-items: center;">
<select style="width: 100%; text-align: center; font-size: 35px;" name="addstorecategory" onchange="newstorefun()" required>
<option value="" selected disabled>- Category -</option>
<?php
echo $cats;
?>
</select>
</div>
</div>
<div style="width: 15%;">
</div>
</div>
</div>
</div>
</form>

<br>
<br>

<div style="text-align: center;">
<a href="index.php"><button id="homebtn" onload="scrolltobottom()" style="font-size: 55px; text-align: center;">Home</button></a>
</div>

<br>
<br>

<!--ADD NEW STORE ON CATEGORY SELECTION-->
<script>
function newstorefun() {
let form2 = document.getElementById("form2");
let x = form2.addstore.value;
if (x == "") {
alert("Store name is required.");
} else {
form2.submit();
}
}
</script>

<script>
const myTimeout = setTimeout(scrolltobottom, 250);
const element = document.getElementById("homebtn");
function scrolltobottom() {
	element.scrollIntoView(true);
}
</script>

</body>
