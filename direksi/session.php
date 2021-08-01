<?php
session_start();
if ($_SESSION['level'] == "direksi") {
	include "../conn.php";
} else {
    header('location:../direksi/index.php');
}
?>