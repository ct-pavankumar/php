<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
$connection = mysqli_connect("localhost","root","","pma");
if(mysqli_connect_error()){
	echo "There was an error: ".mysqli_connect_error();
	exit;
}

?>