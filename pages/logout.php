<?php
session_start();
unset($_SESSION['admin_id']);
header("location: sign-in.php");

exit();




?>