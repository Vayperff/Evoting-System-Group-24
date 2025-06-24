<?php
require __DIR__ . "/connect.php";

// Include PHPMailer files
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

if (isset($_POST['add_election'])) {
    $election_name = $mysqli->real_escape_string(htmlspecialchars($_POST['election_name'], ENT_QUOTES, 'UTF-8'));
    $election_description = $mysqli->real_escape_string(htmlspecialchars($_POST['election_description'], ENT_QUOTES, 'UTF-8'));
    $start_date = $mysqli->real_escape_string($_POST['start_date']);
    $end_date = $mysqli->real_escape_string($_POST['end_date']);
    $email = "emmymorgan1278@gmail.com"; // Default email

    // Handle election banner upload
    $banner = null;
    if (!empty($_FILES['banner']['name'][0])) {
        $folder = "images/election_banners";
        $random = time();
        $banner_name = strtolower(htmlspecialchars($_FILES['banner']['name'][0], ENT_QUOTES, 'UTF-8'));
        $banner_extension = pathinfo($banner_name, PATHINFO_EXTENSION);
        $banner_name = preg_replace("/\.[^.\s]{3,4}$/", "", $banner_name);
        $banner = $banner_name . '-' . $random . '.' . $banner_extension;

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        move_uploaded_file($_FILES["banner"]["tmp_name"][0], $folder . "/" . $banner);
    } else {
        $banner = null;
    }

    // Insert election data
    $status = "active";
    $sql = $mysqli->prepare("INSERT INTO elections (election_name, election_description, start_date, end_date, election_banner,deleted) VALUES (?, ?, ?, ?, ?,?)");

    if ($sql === false) {
        die("Error preparing statement: " . $mysqli->error);
    }

    $sql->bind_param("ssssss", $election_name, $election_description, $start_date, $end_date, $banner,$status);

    if (!$sql->execute()) {
        die("<script>alert('Error creating election'); document.location.href = 'create_election.php';</script>");
    } else {
        // Send email notification
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'mail.skyratesipifalls.com'; // SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'info@skyratesipifalls.com'; // SMTP username
            $mail->Password = 'Secret@123$$'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Recipients
            $mail->setFrom('info@skyratesipifalls.com', 'ElectionVoting System Group 4');
            $mail->addAddress($email);

            // Email Content
            $mail->isHTML(true);
            $mail->Subject = 'New Election Created';
            $mail->Body = "
                <h4>New Election Created: $election_name</h4>
                <p><strong>Description:</strong> $election_description</p>
                <p><strong>Start Date:</strong> $start_date</p>
                <p><strong>End Date:</strong> $end_date</p>";

            if ($banner) {
                $mail->Body .= "<br><p><strong>Election Banner:</strong></p><br>
                <img src='images/election_banners/$banner' width='300' height='150'>";
            }

            // Send the email
            if ($mail->send()) {
                echo "<script>alert('Election created successfully. Notification sent.'); document.location.href = 'manage_elections.php';</script>";
            } else {
                echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}



//EDIT FOR ELECTIONS
if (isset($_POST['edit_election'])) {
    $id = $mysqli->real_escape_string(htmlspecialchars(filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT),ENT_QUOTES,'UTF-8'));
    
    $image = $mysqli->real_escape_string(htmlspecialchars($_POST['image'], ENT_QUOTES, 'UTF-8'));
    
    $election_name = $mysqli->real_escape_string(htmlspecialchars($_POST['election_name'], ENT_QUOTES, 'UTF-8'));
    $election_description = $mysqli->real_escape_string(htmlspecialchars($_POST['election_description'], ENT_QUOTES, 'UTF-8'));
    $start_date = $mysqli->real_escape_string($_POST['start_date']);
    $end_date = $mysqli->real_escape_string($_POST['end_date']);
    $email = "emmymorgan1278@gmail.com"; // Default email

    // Handle election banner upload
    $banner = null;
    if (!empty($_FILES['banner']['name'][0])) {
        $folder = "images/election_banners";
        $random = time();
        $banner_name = strtolower(htmlspecialchars($_FILES['banner']['name'][0], ENT_QUOTES, 'UTF-8'));
        $banner_extension = pathinfo($banner_name, PATHINFO_EXTENSION);
        $banner_name = preg_replace("/\.[^.\s]{3,4}$/", "", $banner_name);
        $banner = $banner_name . '-' . $random . '.' . $banner_extension;

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        move_uploaded_file($_FILES["banner"]["tmp_name"][0], $folder . "/" . $banner);
    } else {
        $banner = $image;
    }

       $sql = $mysqli->prepare("UPDATE elections SET election_name = ?, election_description = ?, start_date = ?, end_date = ?, election_banner = ? WHERE id = ?");
       
    //$sql->bind_param("sssssi", $election_name, $election_description, $start_date, $end_date, $banner, $id);

    if ($sql === false) {
        die("Error preparing statement: " . $mysqli->error);
    }

   
    $sql->bind_param("sssssi", $election_name, $election_description, $start_date, $end_date, $banner, $id);
    
    

    if (!$sql->execute()) {
        die("<script>alert('Error creating election'); document.location.href = 'add_election.php';</script>");
    } else {
        // Send email notification
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'mail.skyratesipifalls.com'; // SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'info@skyratesipifalls.com'; // SMTP username
            $mail->Password = 'Secret@123$$'; // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            // Recipients
            $mail->setFrom('info@skyratesipifalls.com', 'ElectionVoting System Group 4');
            $mail->addAddress($email);

            // Email Content
            $mail->isHTML(true);
            $mail->Subject = 'Election Edited';
            $mail->Body = "
                <h4>Election Edited: $election_name</h4>
                <p><strong>Description:</strong> $election_description</p>
                <p><strong>Start Date:</strong> $start_date</p>
                <p><strong>End Date:</strong> $end_date</p>";

            if ($banner) {
                $mail->Body .= "<br><p><strong>Election Banner:</strong></p><br>
                <img src='images/election_banners/$banner' width='300' height='150'>";
            }
            

            // Send the email
            if ($mail->send()) {
                echo "<script>alert('Election edited successfully. Notification sent.'); 
                   document.location.href = 'manage_elections.php';
                </script>";
            } else {
                echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>


