<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();
require __DIR__."/connect.php";
if(isset($_SESSION['candidate_id'])) {
    
     if(isset($_SESSION['candidate_id'])) {
    $adminId = $mysqli->real_escape_string(filter_var($_SESSION['candidate_id'],FILTER_SANITIZE_NUMBER_INT));
	$adminId = $mysqli->real_escape_string(filter_var($_SESSION['candidate_id'],FILTER_SANITIZE_NUMBER_INT));
	$sqlAdmin = $mysqli->prepare("SELECT * FROM candidates WHERE id = ?");
	$sqlAdmin->bind_param("s",$adminId);
	$sqlAdmin->execute();
	$resAdmin = $sqlAdmin->get_result();
	$fetchAdmin = $resAdmin->fetch_object();
	
	
	
	//count voters
	$sqlCountVoters = $mysqli->prepare("SELECT * FROM student_sign_up WHERE deleted = 0");
	$sqlCountVoters->execute();
	$resCountVotersNum = $sqlCountVoters->get_result();
	
	
	
	$sqlCountElections = $mysqli->prepare("SELECT * FROM elections WHERE deleted != 'DELETED' AND status != 'COMPLETED'");
	$sqlCountElections->execute();
	$resCounElectionsNum = $sqlCountElections->get_result();
	
	
	
	$sqlCountElections1 = $mysqli->prepare("SELECT * FROM elections WHERE deleted != 'DELETED' AND status = 'COMPLETED'");
	$sqlCountElections1->execute();
	$resCounElectionsNum1 = $sqlCountElections1->get_result();
	
	
	$sqlCountTotalVotes = $mysqli->prepare("SELECT * FROM votes WHERE voting_status != 1");
	$sqlCountTotalVotes->execute();
	$resCounTotalVotesNum = $sqlCountTotalVotes->get_result();
	
	
	
	
	
    }
}
else {
    header("location: sign-in.php");
}

?>
