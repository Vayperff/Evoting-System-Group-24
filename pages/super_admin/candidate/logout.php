<?php
session_start();
unset($_SESSION['candidate_id']);
header("location: sign-in.php");

exit();




?>