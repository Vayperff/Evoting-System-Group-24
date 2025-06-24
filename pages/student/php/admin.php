<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
require __DIR__."/connect.php";
if(isset($_SESSION['student_id'])) {
    
     if(isset($_SESSION['student_id'])) {
    $adminId = $mysqli->real_escape_string(filter_var($_SESSION['student_id'],FILTER_SANITIZE_NUMBER_INT));
	$adminId = $mysqli->real_escape_string(filter_var($_SESSION['student_id'],FILTER_SANITIZE_NUMBER_INT));
	$sqlAdmin = $mysqli->prepare("SELECT * FROM  student_sign_up WHERE id = ?");
	$sqlAdmin->bind_param("s",$adminId);
	$sqlAdmin->execute();
	$resAdmin = $sqlAdmin->get_result();
	$fetchStudent = $resAdmin->fetch_object();
    }
}
else {
    header("location: sign-in.php");
}

?>
