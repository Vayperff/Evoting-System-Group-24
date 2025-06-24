<?php
require __DIR__ . "/connect.php";



error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


$sql = $mysqli->prepare("SELECT * FROM elections WHERE deleted != 'DELETED' AND status != 'COMPLETED' ORDER BY date_created DESC");
$sql->execute();
$elections = $sql->get_result();


$sqlCompleted = $mysqli->prepare("SELECT * FROM elections WHERE deleted != 'DELETED'  AND status = 'COMPLETED' ORDER BY date_created DESC");
$sqlCompleted->execute();
$electionsCompleted = $sqlCompleted->get_result();


$useridForVH = $fetchStudent->id;

$sqlCompletedVoteHistory = $mysqli->prepare("SELECT * FROM votes WHERE user_id = ? AND voting_status = 1 ORDER BY date_created DESC");
$sqlCompletedVoteHistory->bind_param("i",$useridForVH);
$sqlCompletedVoteHistory->execute();
$electionsCompletedVoteHistory = $sqlCompletedVoteHistory->get_result();





/*

if(isset($_POST['complete_elections'])) {
    $currentDate = date("Y-m-d");
    $voting_status = 1;
    $status = htmlspecialchars("COMPLETED");
    $date = date("Y-m-d H:i:s");
    //$results = $mysqli->real_escape_string(htmlspecialchars($_POST['results'],ENT_QUOTES,'UTF-8'));
    
    
    $id = $mysqli->real_escape_string(filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT));
    $sql = $mysqli->prepare("SELECT * FROM elections WHERE id = ? AND end_date = ?");
    $sql->bind_param("is", $id, $currentDate);

    if($sql->execute()) {
        $res = $sql->get_result();
        $data = $res->fetch_object();

        if ($data) { // Ensure election exists
            // Select from votes 
            $sqlvote = $mysqli->prepare("SELECT * FROM votes WHERE election_id = ? AND voting_status = 0;");
            $sqlvote->bind_param("i", $id);

            if($sqlvote->execute()) {
                $resvote = $sqlvote->get_result();
                
                while($row2 = $resvote->fetch_object()) {
                    if ($row2) { // Ensure we have data
                        $voter_email = htmlspecialchars($row2->email, ENT_QUOTES, 'UTF-8');
                        $candidate_role = htmlspecialchars($row2->candidate_role);

                        try {
                            $mail = new PHPMailer(true);
                            $mail->isSMTP();
                            $mail->Host = 'mail.skyratesipifalls.com';
                            $mail->SMTPAuth = true;
                            $mail->Username = 'info@skyratesipifalls.com';
                            $mail->Password = 'Secret@123$$';
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                            $mail->Port = 465;

                            $mail->setFrom('info@skyratesipifalls.com', 'Evoting System Group 24');
                            $mail->addAddress($voter_email);

                            $mail->isHTML(true);
                            $mail->Subject = 'Elections Completed';
                            $mail->Body = "<h4>Elections for ".$candidate_role." have been completed. Log in to check the results.</h4><br>
                                           Date: ".$date."<br>";

                            $mail->send();
                        } catch (Exception $e) {
                            error_log("Voter Email Failed: " . $mail->ErrorInfo);
                        }
                    }
                }

                // Fetch distinct candidates
                $sqlcandidates = $mysqli->prepare("SELECT DISTINCT candidate_id FROM votes WHERE election_id = ? AND voting_status = 0");
                $sqlcandidates->bind_param("i",$id);

                if($sqlcandidates->execute()) {
                    $sqlrescandidates = $sqlcandidates->get_result();

                    while($row3 = $sqlrescandidates->fetch_object()) {
                        $idCandidate = $row3->candidate_id;

                        $sqlgetCandidateEmail = $mysqli->prepare("SELECT * FROM candidates WHERE id = ? AND deleted != 'DELETED'");
                        $sqlgetCandidateEmail->bind_param("i", $idCandidate);
                        $sqlgetCandidateEmail->execute();
                        $resgetCandidateEmail = $sqlgetCandidateEmail->get_result();
                        $candidateEmails = $resgetCandidateEmail->fetch_object();

                        if ($candidateEmails) {
                            $candidate_Email = $candidateEmails->email;
                            $candidate_role = $candidateEmails->candidate_role;

                            try {
                                $mail = new PHPMailer(true);
                                $mail->isSMTP();
                                $mail->Host = 'mail.skyratesipifalls.com';
                                $mail->SMTPAuth = true;
                                $mail->Username = 'info@skyratesipifalls.com';
                                $mail->Password = 'Secret@123$$';
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                                $mail->Port = 465;

                                $mail->setFrom('info@skyratesipifalls.com', 'Evoting System Group 24');
                                $mail->addAddress($candidate_Email);

                                $mail->isHTML(true);
                                $mail->Subject = 'Elections Completed';
                                $mail->Body = "<h4>Elections for ".$candidate_role." have been completed. Log in to check the results.</h4><br>
                                               Date: ".$date."<br>";

                                $mail->send();
                            } catch (Exception $e) {
                                error_log("Candidate Email Failed: " . $mail->ErrorInfo);
                            }
                        }
                    }
                }
            }

            // Update voting status in votes table
            $sqlupdatevotes = $mysqli->prepare("UPDATE votes SET voting_status = ? WHERE election_id = ?");
            $sqlupdatevotes->bind_param("ii", $voting_status, $id);
            $sqlupdatevotes->execute();
        }
    }

    // Update elections table status
    $sqlUpdate = $mysqli->prepare("UPDATE elections SET status = ? WHERE id = ?");
    $sqlUpdate->bind_param("si", $status, $id);
    $sqlUpdate->execute();

    // Redirect once everything is done
    echo "<script>alert('Elections have been completed successfully.'); document.location.href = 'dashboard.php';</script>";
}

*/


?>
