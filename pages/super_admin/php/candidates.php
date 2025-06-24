<?php
require __DIR__ . "/connect.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$sql = $mysqli->prepare("SELECT * FROM candidates WHERE deleted != 'DELETED' AND election_status = 0 ORDER BY date_created DESC");
$sql->execute();
$res = $sql->get_result();
?>
