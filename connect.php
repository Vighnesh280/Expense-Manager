<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "budget_planner";

$conn = mysqli_connect($host,$user,$password,$db);

if (!$conn) {
	echo "DB Connection failed with error message:".mysqli_connect_error();
}
?>