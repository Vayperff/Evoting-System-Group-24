<?php
require __DIR__ . "/connect.php";
require 'PHPMailer-6.9.1/src/PHPMailer.php';
require 'PHPMailer-6.9.1/src/SMTP.php';
require 'PHPMailer-6.9.1/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['vote_user'])) {
    // Sanitize input
    
    $userid = filter_var($_POST['userid'],FILTER_SANITIZE_NUMBER_INT);
    
    $candidate_id = $mysqli->real_escape_string(filter_var($_POST['candidate_id'], FILTER_SANITIZE_NUMBER_INT));
    
    $election_id = $mysqli->real_escape_string(filter_var($_POST['election_id'], FILTER_SANITIZE_NUMBER_INT));
    
    $candidate_name = $mysqli->real_escape_string($_POST['candidate_name']);
    
    
      $candidate_role = $mysqli->real_escape_string($_POST['candidate_role']);
    
    $voter_email = $mysqli->real_escape_string(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    
    
    $date = date("d, M Y");
    
    // Check if the user has already voted
    /*
    $checkVote = $mysqli->prepare("SELECT id FROM votes WHERE voter_email = ? AND election_id = ?");
    $checkVote->bind_param("si", $voter_email, $election_id);
    $checkVote->execute();
    $result = $checkVote->get_result();
    
    if ($result->num_rows > 0) {
        die("<script>alert('You have already voted in this election.'); document.location.href = 'elections.php';</script>");
    }
    */
    
    
    $status = "voted";
    $status2 = 0;
  // Insert vote into database
$sql = $mysqli->prepare("INSERT INTO votes (user_id, candidate_id, election_id, email, date_format, candidate_name, candidate_role,status,voting_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

// Bind parameters (types: s = string, i = integer)
$sql->bind_param("siissssss", $userid, $candidate_id, $election_id, $voter_email, $date, $candidate_name, $candidate_role,$status,$status2);

// Execute the query
//$sql->execute();

    
    if ($sql->execute()) {
        // Send email confirmation
        $mail = new PHPMailer(true);
        try {
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
            $mail->Subject = 'Voting Confirmation';
            $mail->Body = "<h4>You have successfully voted for 
                
                ".$candidate_name." for the role of ".$candidate_role."  <br>
                
                Today   ".$date." <br>
                ";

            $mail->send();
            echo "<script>alert('Your vote has been successfully recorded. A confirmation email has been sent.'); document.location.href = 'dashboard.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Vote recorded, but email confirmation failed: " . $mail->ErrorInfo . "'); document.location.href = 'dashboard.php';</script>";
        }
    } else {
        die("<script>alert('Error recording your vote. Please try again.'); document.location.href = 'elections.php';</script>");
    }
}


//delete vote
if(isset($_POST['cancel_vote'])) {
    $id = $mysqli->real_escape_string(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));
    $candidate_name = $mysqli->real_escape_string(htmlspecialchars($_POST['candidate_name'], ENT_QUOTES, 'UTF-8'));
    $candidate_role = $mysqli->real_escape_string(htmlspecialchars($_POST['candidate_role'], ENT_QUOTES, 'UTF-8'));
    $voter_email = $mysqli->real_escape_string(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
    
    $sql = $mysqli->prepare("DELETE FROM votes WHERE id = ?");
    $sql->bind_param("i", $id);
    
    if(!$sql->execute()) {
        die("Error");
    } else {
        // Send cancellation email
        $mail = new PHPMailer(true);
        try {
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
            $mail->Subject = 'Vote Cancellation Confirmation';
            $mail->Body = "<h4>Your vote has been successfully canceled.</h4>
                          <p>You previously voted for <strong>".$candidate_name."</strong> for the role of <strong>".$candidate_role."</strong>,</p>
                          <p>If this was a mistake, please <a target='blank'  href='https://evotingsystemgroup24.skyratesipifalls.com/student/'> log in </a> and vote again.</p>
                          <p>Thank you,</p>
                          <p><strong>Evoting System Group 24</strong></p>";

            $mail->send();
            echo "<script>alert('You successfully canceled your vote for this candidate. A confirmation email has been sent.'); document.location.href = 'dashboard.php';</script>";
        } catch (Exception $e) {
            echo "<script>alert('Vote canceled, but email confirmation failed: " . $mail->ErrorInfo . "'); document.location.href = 'dashboard.php';</script>";
        }
    }
}
?>