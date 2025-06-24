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
if (isset($_POST['add_candidate1'])) {
    // Sanitize and prepare form fields
    $candidate_name = $mysqli->real_escape_string(htmlspecialchars($_POST['candidate_name'], ENT_QUOTES, 'UTF-8'));
    $candidate_bio = $mysqli->real_escape_string(htmlspecialchars($_POST['candidate_bio'], ENT_QUOTES, 'UTF-8'));
    $email = $mysqli->real_escape_string(filter_var($_POST['candidate_email'], FILTER_SANITIZE_EMAIL));

    // Split the 'candidate_role' value (election_id|election_name) from the form
    list($election_id, $election_name) = explode('|', $_POST['candidate_role']);

    // Sanitize 'election_id' and 'election_name'
    $election_id = $mysqli->real_escape_string(filter_var($election_id, FILTER_SANITIZE_NUMBER_INT));
    $election_name = $mysqli->real_escape_string(htmlspecialchars($election_name, ENT_QUOTES, 'UTF-8'));

    $candidate_role = $election_name; // Set the role as the election name

    // Check if email already exists
    $sqlEmail = $mysqli->prepare("SELECT * FROM candidates WHERE email = ? AND deleted != 'DELETED' AND election_status = 0");
    $sqlEmail->bind_param("s", $email);
    $sqlEmail->execute();
    $resEmail = $sqlEmail->get_result();
    $obEmail = $resEmail->fetch_object();

    if ($obEmail !== null) {
        die("<script>alert('This email ($email) is already registered as a candidate'); document.location.href = 'add_candidate.php';</script>");
    }

    // Handle profile image upload
    $image = null;
    if (!empty($_FILES['image']['name'][0])) {
        $folder = "images/candidate_images";
        $random = time();
        $image_name = strtolower(htmlspecialchars($_FILES['image']['name'][0], ENT_QUOTES, 'UTF-8'));
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_name = preg_replace("/\.[^.\s]{3,4}$/", "", $image_name);
        $image = $image_name . '-' . $random . '.' . $image_extension;

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        move_uploaded_file($_FILES["image"]["tmp_name"][0], $folder . "/" . $image);
    } else {
        $image = null;
    }

    $date = date("d, M Y");
 
 $deleted = "active";
 $eStatus = 0;
    // Insert candidate data
    $sql = $mysqli->prepare("INSERT INTO candidates (candidate_name, candidate_role, candidate_bio, email, candidate_image, date_format, election_id,deleted, election_status) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)");

    if ($sql === false) {
        die("Error preparing statement: " . $mysqli->error);
    }

    // Bind parameters
    $sql->bind_param("sssssssss", $candidate_name, $candidate_role, $candidate_bio, $email, $image, $date, $election_id,$deleted,$eStatus);

    // Execute query
    if (!$sql->execute()) {
        die("<script>alert('Error during registration'); document.location.href = 'add_candidate.php';</script>");
    } else {
        // Send confirmation email to candidate
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
            $mail->addAddress('emmymorgan1278@gmail.com');
            $mail->addAddress($email); 

            // OTP Generation
            $OTP = mt_rand(100000, 999999);

            // Email Content
            $mail->isHTML(true);                                      
            $mail->Subject = 'Candidate Registration Confirmation';
            $mail->Body    = "
                <h4>Welcome, $candidate_name!</h4><br>
                <p>You have successfully been registered as a candidate for <b>$candidate_role</b>.</p>
                <p><strong>Email:</strong> $email</p><br>
                <p><strong>Bio:</strong> $candidate_bio</p><br>
                <p><strong>Profile Image:</strong> <img src='images/candidate_images/$image' width='100' height='100'></p><br>
                <p>Registration Date: $date</p><br>
            ";

            // Send the email
            if ($mail->send()) {
                echo "<script>alert('Candidate registration successful. An email has been sent.');
                document.location.href = 'manage_candidates.php';</script>
                </script>";
            } else {
                echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}



//FOR EDITING 
if (isset($_POST['update_candidate1'])) {
    $id = $mysqli->real_escape_string(filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT));
    
    // Sanitize inputs
    $candidate_name = $mysqli->real_escape_string(htmlspecialchars($_POST['candidate_name'], ENT_QUOTES, 'UTF-8'));
    $candidate_bio = $mysqli->real_escape_string(htmlspecialchars($_POST['candidate_bio'], ENT_QUOTES, 'UTF-8'));
    $email = $mysqli->real_escape_string(filter_var($_POST['candidate_email'], FILTER_SANITIZE_EMAIL));

    // Fix the explode() issue - process each selected candidate_role
    if (!empty($_POST['candidate_role']) && is_array($_POST['candidate_role'])) {
        foreach ($_POST['candidate_role'] as $role) {
            list($election_id, $election_name) = explode('|', $role);
        }
    } else {
        die("<script>alert('Invalid candidate role selection.'); document.location.href = 'manage_candidates.php';</script>");
    }

    $election_id = $mysqli->real_escape_string(filter_var($election_id, FILTER_SANITIZE_NUMBER_INT));
    $candidate_role = $mysqli->real_escape_string(htmlspecialchars($election_name, ENT_QUOTES, 'UTF-8'));

    // Check if email already exists
    $sqlEmail = $mysqli->prepare("SELECT * FROM candidates WHERE id != ? AND email = ? AND deleted != 'DELETED'");
    $sqlEmail->bind_param("is", $id, $email);
    $sqlEmail->execute();
    $resEmail = $sqlEmail->get_result();

    if ($resEmail->num_rows > 0) {
        die("<script>alert('This email ($email) is already registered for another candidate.'); document.location.href = 'manage_candidates.php';</script>");
    }

    // Handle profile image upload
    $image = null;
    if (!empty($_FILES['image']['name'][0])) {
        $folder = "images/candidate_images";
        $random = time();
        $image_name = strtolower(htmlspecialchars($_FILES['image']['name'][0], ENT_QUOTES, 'UTF-8'));
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        $image_name = preg_replace("/\.[^.\s]{3,4}$/", "", $image_name);
        $image = $image_name . '-' . $random . '.' . $image_extension;

        if (!file_exists($folder)) {
            mkdir($folder, 0777, true);
        }

        move_uploaded_file($_FILES["image"]["tmp_name"][0], $folder . "/" . $image);
    } else {
        // If no new image is uploaded, keep the existing image
        $query = $mysqli->prepare("SELECT candidate_image FROM candidates WHERE id = ?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();
        $existingImage = $result->fetch_object();
        $image = $existingImage->candidate_image;
    }

    $date = date("d, M Y");

    // **Fix the update query** (include the `id` parameter)
    $sql = $mysqli->prepare("UPDATE candidates 
        SET candidate_name = ?, 
            candidate_role = ?, 
            candidate_bio = ?, 
            email = ?, 
            candidate_image = ?, 
            date_format = ?, 
            election_id = ? 
        WHERE id = ?");
    
    if ($sql === false) {
        die("Error preparing statement: " . $mysqli->error);
    }

    // Bind all parameters correctly
    $sql->bind_param("ssssssii", $candidate_name, $candidate_role, $candidate_bio, $email, $image, $date, $election_id, $id);

    // Execute query
    if (!$sql->execute()) {
        die("<script>alert('Error updating candidate details.'); document.location.href = 'manage_candidates.php';</script>");
    } else {
        // Send confirmation email to candidate
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
            $mail->addAddress($email); 

            // Email Content
            $mail->isHTML(true);                                      
            $mail->Subject = 'Candidate Registration Update';
            $mail->Body    = "
                <h4>Hello, $candidate_name!</h4><br>
                <p>Your candidate details have been successfully updated for <b>$candidate_role</b>.</p>
                <p><strong>Email:</strong> $email</p><br>
                <p><strong>Bio:</strong> $candidate_bio</p><br>
                <p><strong>Profile Image:</strong> <img src='images/candidate_images/$image' width='100' height='100'></p><br>
                <p>Updated On: $date</p><br>
            ";

            // Send email
            if ($mail->send()) {
                echo "<script>alert('Candidate details updated successfully, Notification sent'); document.location.href = 'manage_elections.php';</script>";
            } else {
                echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}


?>