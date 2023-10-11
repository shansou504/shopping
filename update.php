<?php
include('connection.php');
$id=$_POST['id'];
$dat=$_POST['dat'];
$store=$_POST['store'];
$items=$_POST['items'];
$note=$_POST['note'];
$cat=$_POST['cat'];
$total=$_POST['total'];
if($_POST['closed']==1) {
	$closed='1';
} else {
	$closed='0';
}
if(!$total) {
	$total='NULL';
}
$sqlins=mysqli_query($mysqli, "UPDATE rec SET dat='$dat', items='$items', note='$note', cat='$cat', total=$total, closed='$closed' WHERE id='$id'"); 
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css?ver=1.1">
	</head>
	<body>
		<div style="height: 66%; width: 100%;">
			<div style="height: 100%;" class="flexcol">
				<form id="formid" name="form" action="
				<?php
					if($_POST['search']==1) {
						echo "search.php";
					} else {
						echo "store.php";
					}
				?>
					" method="post">
					<div class="flexcol">
						<input id="id" name="id" type="hidden" value="<?php echo $id; ?>"/>
						<input id="storeid" name="store" type="hidden" value="<?php echo $store; ?>"/>
						<button id="editid" name="edit" value="1">
							<?php
								if($closed) {
									echo "Create new receipt for ";
								} else {
									echo "Back to ";
								}
							?>
							<?php echo $store; ?>
						</button>
					</div>
				</form>
				<a href="index.php"><button style="width: 100%" id="homebtnid" name="homebtn">Home</button></a>
			</div>
		</div>
	</body>
</html>
