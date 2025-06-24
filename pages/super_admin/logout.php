<?php
session_start();
unset($_SESSION['super_admin_id']);
header("location: sign-in.php");

exit();




?>