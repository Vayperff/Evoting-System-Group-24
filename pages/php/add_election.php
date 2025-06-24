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

if (isset($_POST['add_election'])) {
    $election_name = $mysqli->real_escape_string(htmlspecialchars($_POST['election_name'], ENT_QUOTES, 'UTF-8'));
    $election_description = $mysqli->real_escape_string(htmlspecialchars($_POST['election_description'], ENT_QUOTES, 'UTF-8'));
    $start_date = $mysqli->real_escape_string($_POST['start_date']);
    $end_date = $mysqli->real_escape_string($_POST['end_date']);
    $email = "emmymorgan1278@gmail.com"; // Default email
    $adminsEmail = $fetchAdmin->email;
    
     $todaysDate =  date("Y-m-d");


   if($start_date < $todaysDate)  {
       die("<script>alert('You cannot enter a past date for this election')
         document.location.href = 'create_election.php'
          </script>");
          
   }
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
    $status2 = "NOT_COMPLETED";
    
    $sql = $mysqli->prepare("INSERT INTO elections (election_name, election_description, start_date, end_date, election_banner,deleted,status) VALUES (?, ?, ?, ?, ?, ?,? )");

    if ($sql === false) {
        die("Error preparing statement: " . $mysqli->error);
    }

    $sql->bind_param("sssssss", $election_name, $election_description, $start_date, $end_date, $banner,$status,$status2);

    if (!$sql->execute()) {
        die("<script>alert('Error creating election'); document.location.href = 'create_election.php';</script>");
    } else {
        // Send email notification
        $mail = new PHPMailer(true);
        try {
           // Server settings
                $mail->isSMTP();                                          
                $mail->Host = 'mail.skyratesipifalls.com';                 
                $mail->SMTPAuth = true;                                    
                $mail->Username = 'evotingsystem@skyratesipifalls.com';             
                $mail->Password = 'Secret@123$$';                          
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          
                $mail->Port = 465; 

            // Recipients
            $mail->setFrom('info@skyratesipifalls.com', 'ElectionVoting System Group 4');
            $mail->addAddress($email);
            $mail->addAddress($adminsEmail);
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
        $folder = "../images/election_banners";
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
                   document.location.href = '../manage_elections.php';
                </script>";
            } else {
                echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}


if (isset($_POST['add_candidate1'])) {
    // Sanitize and prepare form fields
    $candidate_name = $mysqli->real_escape_string(htmlspecialchars($_POST['candidate_name'], ENT_QUOTES, 'UTF-8'));
    $candidate_bio = $mysqli->real_escape_string(htmlspecialchars($_POST['candidate_bio'], ENT_QUOTES, 'UTF-8'));
    $email = $mysqli->real_escape_string(htmlspecialchars($_POST['candidate_email'], FILTER_SANITIZE_EMAIL));

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
        die("<script>alert('This email ($email) is already registered as a candidate'); document.location.href = 'manage_elections.php';</script>");
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
                $mail->Username = 'evotingsystem@skyratesipifalls.com';             
                $mail->Password = 'Secret@123$$';                          
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          
                $mail->Port = 465;                                        

            // Recipients
            $mail->setFrom('info@skyratesipifalls.com', 'Evoting System Group 24');
            $mail->addAddress('emmymorgan1278@gmail.com');
            $mail->addAddress($email); 

            // OTP Generation
            $OTP = mt_rand(100000, 999999);

            // Email Content
            $mail->isHTML(true);                                      
            $mail->Subject = 'Candidate Registration Confirmation';
            $mail->Body    = "
                <h4>Welcome, $candidate_name!</h4><br>
                <p>You have successfully registered as a candidate for <b>$candidate_role</b>.</p>
                <p><strong>Email:</strong> $email</p><br>
                <p><strong>Bio:</strong> $candidate_bio</p><br>
                <p><strong>Profile Image:</strong> <img src='images/candidate_images/$image' width='100' height='100'></p><br>
                <p>Registration Date: $date</p><br>
            ";

            // Send the email
            if ($mail->send()) {
                echo "<script>alert('Candidate registration successful. An email has been sent.');
                document.location.href = 'manage_elections.php';</script>
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


