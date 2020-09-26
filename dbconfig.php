<?php
$host="localhost";
$db="esewa";
$username="root";
$pass="";
$conn=new mysqli($host,$username,$pass,$db);
if($conn->connect_error)
{
	echo "failed to connect to mysql";
	exit;
}
?>