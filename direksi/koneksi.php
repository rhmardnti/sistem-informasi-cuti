<?php

/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cuti";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


?>