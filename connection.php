<?php
$config = parse_ini_file("/var/www/private/config.ini");
$mysqli = mysqli_connect($config['servername'],$config['username'],$config['password'],$config['database']);
?>
