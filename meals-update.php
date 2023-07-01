<?php
include('connection.php');
$id = $_POST['id'];
$mealstext = $_POST['mealstext'];
$sqlmealsupdate = mysqli_query($mysqli, "UPDATE meals SET mealstext = '$mealstext' WHERE id = '$id'");
header('Location: index.php');
?>
