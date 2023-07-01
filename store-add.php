<!--SQL-->
<?php
include('connection.php');
$addstore = $_POST['addstore'];
$category = $_POST['addstorecategory'];
$sqladdstore = mysqli_query($mysqli, "INSERT INTO store (id, store, category) VALUES (NULL, '$addstore', '$category')");
?>

<!--GO TO CHECKLIST FOR NEW STORE-->
<form id="form" action="storelist.php" method="post">
<input type="hidden" name="store" value="<?php echo $addstore;?>" onchange="gotochecklist()">
</form>

<!--GO TO CHECKLIST FOR NEW STORE AUTOMATICALLY-->
<script>
const myTimeout = setTimeout(gotochecklist, 250);
function gotochecklist() {
let form = document.getElementById("form");
form.submit();
}
</script>