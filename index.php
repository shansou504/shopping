<!--SQL-->
<?php 
include('connection.php');
$sqlstore = mysqli_query($mysqli, "SELECT * FROM store ORDER BY store ASC");
$sqlcategory = mysqli_query($mysqli, "SELECT * FROM category ORDER BY category DESC");
$cats = "";
while ($rowcategory = mysqli_fetch_assoc($sqlcategory)) {
$cats = "<option value'" . $rowcategory['category'] . "'>" . $rowcategory['category'] . "</option>" . "\n" . $cats;
}
$sqlmeals = mysqli_query($mysqli, "SELECT * FROM meals");
?>

<head>
<link rel="stylesheet" type="text/css" href="style.css?ver=1.3"/>
</head>
<body>

<br>
<br>
<!--SELECT STORE-->
<div style="display: flex; justify-content: center; align-items: center;">
<div style="width: 90%;">
<div style="display: flex; justify-content: center; align-items: center;">
<div style="width: 50%;">
<form id="form" action="checklist.php" method="post">
<div style="display: flex; justify-content: center; align-items: center;">
<div style="width: 90%;">
<select style="width: 100%; text-align: center; font-size: 42px;" onchange="subfun()" name="store">
<option selected disabled> - Select a Store - </option>
<?php
while ($rowstore = mysqli_fetch_assoc($sqlstore)) {
echo "<option value='" . $rowstore['store'] . "'>" . $rowstore['store'] . "</option>";
}
?>
</select>
</div>
</div>
</div>
</form>
<div style="width: 50%;">
<div style="display: flex; justify-content: center; align-items: center;">
<div style="width: 90%;">
<a href="storelist.php"><Button style="font-size: 42px; text-align: center; width: 100%;">Edit Stores</Button></a>
<p></p>
</div>
</div>
</div>
</div>
</div>
</div>

<br>
<br>
<!--GO TO SHOPPING LIST-->
<div style="display: flex; justify-content: center; align-items: center;">
<div style="width: 90%;">
<div style="display: flex; justify-content: center; align-items: center;">
<div style="width: 50%; text-align: center;">
<a href="shoppinglist.php"><Button style="font-size: 42px; text-align: center; width: 90%;">Shopping List</Button></a>
</div>
<!--GO TO RECORD RECEIPTS-->
<div style="width: 50%; text-align: center;">
<a href="receipts.php"><Button style="font-size: 42px; text-align: center; width: 90%;">Record Receipts</Button></a>
</div>
</div>
</div>
</div>

<br>
<br>
<br>

<!--MEAL PLANNING-->
<?php
while ($rowmeals = mysqli_fetch_assoc($sqlmeals)) {
    echo "<form id='mealform" . $rowmeals['id'] . "' action='meals-update.php' method='post'>";
    echo "<input type='hidden' name='id' value='" . $rowmeals['id'] . "'>";
    echo "</form>";
    echo "<div style='display: flex; justify-content: center; align-items: center;'>";
    echo "<textarea style='width: 160px; font-size: 36px;' rows='3' cols='1' id='days" . $rowmeals['id'] . "' value='" . $rowmeals['days'] . "' name='days' form='mealform" . $rowmeals['id'] . "' pattern='^[a-zA-Z0-9 ]+$' title='Letters or numbers only' disabled>" . $rowmeals['days'] . "</textarea>";
    echo "<textarea style='width: 600px; font-size: 36px;' rows='3' cols='1' id='mealstext" . $rowmeals['id'] . "' value='" . $rowmeals['mealstext'] . "' name='mealstext' form='mealform" . $rowmeals['id'] . "' pattern='^[a-zA-Z0-9 " . '\n' . "]+$' title='Letters or numbers only' onchange='updatemeals" . $rowmeals['id'] . "()'>" . $rowmeals['mealstext'] . "</textarea>";
    echo "</div>";
    echo "<script>";
    echo "function updatemeals" . $rowmeals['id'] . "() {";
    echo "let form" . $rowmeals['id'] . " = document.getElementById('mealform" . $rowmeals['id'] . "');";
    echo "let b" . $rowmeals['id'] . " = form" . $rowmeals['id'] . ".mealstext" . $rowmeals['id'] . ".value;";
    echo "let pat = /^[a-zA-Z0-9 " . '\n' ."]+$/;";
    echo "let mat" . $rowmeals['id'] . " = b" . $rowmeals['id'] . ".match(pat);";
    echo "if (b" . $rowmeals['id'] . " == '') {";
    echo "form" . $rowmeals['id'] . ".submit();";
    echo "} else if (mat" . $rowmeals['id'] . " == null) {;";
    echo "alert('Meal text must contain only letters or numbers. Changes were not saved.');";
    echo "} else {";
    echo "form" . $rowmeals['id'] . ".submit();";
    echo "}";
    echo "}";
    echo "</script>";
}
?>
<br>
<br>
<!--GO TO CHECKLIST ON STORE SELECTION-->
<script>
function subfun() {
let form = document.getElementById("form");
form.submit();
}
</script>

</body>
