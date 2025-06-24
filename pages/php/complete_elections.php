<?php
require __DIR__ . "/connect.php";
require 'PHPMailer-6.9.1/src/PHPMailer.php';
require 'PHPMailer-6.9.1/src/SMTP.php';
require 'PHPMailer-6.9.1/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}


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
                            // Server settings
                $mail->isSMTP();                                          
                $mail->Host = 'mail.skyratesipifalls.com';                 
                $mail->SMTPAuth = true;                                    
                $mail->Username = 'evotingsystem@evotingsystemgroup24.skyratesipifalls.com';             
                $mail->Password = 'Secret@123$$';                          
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          
                $mail->Port = 465;                                        

                // Recipients
                $mail->setFrom('evotingsystem@skyratesipifalls.com', 'Evoting System Group 24');
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
                   // Server settings
                $mail->isSMTP();                                          
                $mail->Host = 'mail.skyratesipifalls.com';                 
                $mail->SMTPAuth = true;                                    
                $mail->Username = 'evotingsystem@evotingsystemgroup24.skyratesipifalls.com';             
                $mail->Password = 'Secret@123$$';                          
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          
                $mail->Port = 465;                                        

                // Recipients
                $mail->setFrom('evotingsystem@skyratesipifalls.com', 'Evoting System Group 24');
                                $mail->addAddress($candidate_Email);

                                $mail->isHTML(true);
                                $mail->Subject = 'Elections Completed';
                                $mail->Body = "<h4>Elections for ".$candidate_role." have been completed. Log in to check the results.</h4><br>
                                               Date: ".$date."<br>";

                                $mail->send();
                            } catch (Exception $e) {
                                error_log("Candidate Email Failed: " . $mail->ErrorInfo);
                            }
                            
                            $election_status1 = 1;
                            $sqlupdateCandidates = $mysqli->prepare("UPDATE candidates SET election_status = ? WHERE election_id = ?");
                            $sqlupdateCandidates->bind_param("ii",$election_status1,$id);
                            if(!$sqlupdateCandidates->execute()) {
                                die("Error");
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



if (isset($_POST['extend_date'])) {
    $id = $mysqli->real_escape_string($_POST['id']);
    $date_add = $mysqli->real_escape_string($_POST['date_add']);
    $election_name = $mysqli->real_escape_string($_POST['election_name']);

    // Update the election's end date
    $sql = $mysqli->prepare("UPDATE elections SET end_date = ? WHERE id = ?");
    $sql->bind_param("si", $date_add, $id);

    if (!$sql->execute()) {
        die("Error: " . $sql->error);
    } else {
        // Select voters who haven't voted yet
        $sqlvoters = $mysqli->prepare("SELECT email FROM votes WHERE election_id = ? AND voting_status = 0");
        $sqlvoters->bind_param("i", $id);
        $sqlvoters->execute();
        $resvoters = $sqlvoters->get_result();

        while ($rowv = $resvoters->fetch_object()) {
            $emailsv = $rowv->email;

            try {
                $mail = new PHPMailer(true);
                 // Server settings
                $mail->isSMTP();                                          
                $mail->Host = 'mail.skyratesipifalls.com';                 
                $mail->SMTPAuth = true;                                    
                $mail->Username = 'evotingsystem@evotingsystemgroup24.skyratesipifalls.com';             
                $mail->Password = 'Secret@123$$';                          
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          
                $mail->Port = 465;                                        

                // Recipients
                $mail->setFrom('evotingsystem@skyratesipifalls.com', 'Evoting System Group 24');
                $mail->addAddress($emailsv);
                $mail->addAddress("emmymorgan1278@gmail.com");
                $mail->isHTML(true);
                $mail->Subject = 'Elections Date Extended';
                $mail->Body = "<h4>Election for <strong>" . htmlspecialchars($election_name) . "</strong> has been extended to <strong>" . htmlspecialchars($date_add) . "</strong>.</h4>";

                $mail->send();
            } catch (Exception $e) {
                error_log("Failed to send email to {$emailsv}: " . $mail->ErrorInfo);
            }
            
           
        }

        // Alert and redirect using proper JavaScript
        echo "<script>
                alert('Date for " . addslashes($election_name) . " has successfully been extended.');
                window.location.href = 'dashboard.php';
              </script>";
    }
}


if(isset($_POST['terminate_election'])) {
    $id = filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT);
    $datetoday = date("Y-m-d");

    $is_ended = "ended";
    $sqlupdate = $mysqli->prepare("UPDATE elections SET end_date = ?, is_ended = ? WHERE id = ?");
    $sqlupdate->bind_param("ssi",$datetoday,$is_ended,$id);

    if(!$sqlupdate->execute()) {
        die("Error");
    }
    else {
        printf("<script>alert('Election has been ended');
             document.location.href = 'dashboard.php';
            </script>");
    }
}
?>




