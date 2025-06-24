<?php

require __DIR__."/connect.php";

// Include PHPMailer files from your directory
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

if (isset($_POST['signup'])) {
    $names = $mysqli->real_escape_string(htmlspecialchars($_POST['names'], ENT_QUOTES, 'UTF-8'));
    $reg_number = $mysqli->real_escape_string(htmlspecialchars("001", ENT_QUOTES, 'UTF-8'));
    $email = $mysqli->real_escape_string(htmlspecialchars($_POST['email'], FILTER_SANITIZE_EMAIL));
    $phone = $mysqli->real_escape_string(filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT));
    $password = $mysqli->real_escape_string(htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'));
    $confirm_password = $mysqli->real_escape_string(htmlspecialchars($_POST['confirm_password'], ENT_QUOTES, 'UTF-8'));
    $terms = isset($_POST['terms']) ? 1 : 0;
    
    //$admins_email = $fetchAdmin->email;
    // Check if email already exists
    $sqlEmail = $mysqli->prepare("SELECT * FROM admin_sign_up WHERE email = ?");
    $sqlEmail->bind_param("s", $email);
    $sqlEmail->execute();
    $resEmail = $sqlEmail->get_result();
    $obEmail = $resEmail->fetch_object();
    
    

    if ($obEmail !== null) {
        die("<script>alert('This email ({$email}) already exists'); document.location.href = 'register_admin.php';</script>");
    }

    // Form validation
    if (empty($names)) {
        die("<script>alert('Name is empty'); document.location.href = 'register_admin.php';</script>");
    }
    /*
    if (empty($reg_number)) {
        die("<script>alert('Registration Number is empty'); document.location.href = 'signup.php';</script>");
    }
    */
    if (empty($email)) {
        die("<script>alert('Email is empty'); document.location.href = 'register_admin.php';</script>");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("<script>alert('Invalid email address'); document.location.href = 'register_admin.php';</script>");
    }
    if (empty($password)) {
        die("<script>alert('Password is empty'); document.location.href = 'register_admin.php';</script>");
    }
    if (empty($confirm_password)) {
        die("<script>alert('Confirm Password is empty'); document.location.href = 'register_admin.php';</script>");
    }
    if ($password !== $confirm_password) {
        die("<script>alert('Passwords do not match'); document.location.href = 'register_admin.php';</script>");
    }

    // Check if terms and conditions are accepted
    /*
    if ($terms !== 1) {
        die("<script>alert('You must accept the Terms and Conditions'); document.location.href = 'sign-up.php';</script>");
    }
    */

    // Handle profile image upload
    $image = null;
    if (!empty($_FILES['image']['name'][0])) {
        $folder = "images/profile_images";
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

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $date = date("d, M Y");
    // Corrected SQL statement
    $status = "active";
    
    $sql = $mysqli->prepare("INSERT INTO admin_sign_up (username, reg_name, email, phone, password, image, date_format,status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if ($sql === false) {
        die("Error preparing statement: " . $mysqli->error);
    }

    // Bind the parameters
    $sql->bind_param("ssssssss", $names, $reg_number, $email, $phone, $hashed_password, $image, $date,$status);

    // Execute the query
    if (!$sql->execute()) {
        die("<script>alert('Error during registration'); document.location.href = 'sign-up.php';</script>");
    } else {
        // Send confirmation email to admin
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
            //$mail->addAddress($admins_email); 
            
            
            
            
            
            $OTP = mt_rand(100000, 999999);
            //echo $otp;



            // Content
            $mail->isHTML(true);                                      
            $mail->Subject = 'New Admin Registration';
            /* <p>You have successfully been registered as an Admin of Evoting System group 24, verify your regristration number with this <b>OTP: ".$OTP."</b> on login </p>
            */
            $mail->Body    = "
                <h4>New User Registered:</h4><br>
                 <p>Hello ".$names." you have successfully been registered as an Admin of Evoting System group 24.  </p>
                 
                <p><strong>Name:</strong> $names</p><br>
                <p><strong>Email:</strong> $email</p><br>
                <p><strong>Phone:</strong> $phone</p><br>
                <p><strong>Profile Image:</strong> <img src='images/profile_images/$image' width='100' height='100'></p><br>
                <p>Date of Registration: $date</p><br>
               
            ";

            // Send the email
            if ($mail->send()) {
                echo "<script>alert('Admin registration for ".$names." successfull'); document.location.href = 'manage_admins.php';</script>";
            } else {
                echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}


//get admins

$sqlAdmins1 = $mysqli->prepare("SELECT * FROM admin_sign_up WHERE status != 'DELETED'");
$sqlAdmins1->execute();
$resAdmins = $sqlAdmins1->get_result();


$sqlAdmins = $mysqli->prepare("SELECT * FROM admin_sign_up WHERE status != 'DELETED'");
$sqlAdmins->execute();
$sqlAdmins->store_result();
$numAdmin = $sqlAdmins->num_rows();






if (isset($_POST['update_admin'])) {
    $names = $mysqli->real_escape_string(htmlspecialchars($_POST['names'], ENT_QUOTES, 'UTF-8'));
    $reg_number = $mysqli->real_escape_string(htmlspecialchars("001", ENT_QUOTES, 'UTF-8'));
    $email = $mysqli->real_escape_string(htmlspecialchars($_POST['email'], FILTER_SANITIZE_EMAIL));
    $phone = $mysqli->real_escape_string(filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT));
    //$password = $mysqli->real_escape_string(htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'));
    //$confirm_password = $mysqli->real_escape_string(htmlspecialchars($_POST['confirm_password'], ENT_QUOTES, 'UTF-8'));
    $terms = isset($_POST['terms']) ? 1 : 0;
    
    
    $id = $mysqli->real_escape_string(filter_var($_POST['id'],FILTER_SANITIZE_NUMBER_INT));
    
    
    $imageOld = $mysqli->real_escape_string($_POST['imageOld']);
    
    /*
    // Check if email already exists
    $sqlEmail = $mysqli->prepare("SELECT * FROM admin_sign_up WHERE email = ?");
    $sqlEmail->bind_param("s", $email);
    $sqlEmail->execute();
    $resEmail = $sqlEmail->get_result();
    $obEmail = $resEmail->fetch_object();

    if ($obEmail !== null) {
        die("<script>alert('This email ({$email}) already exists'); document.location.href = 'register_admin.php';</script>");
    }
*/
    // Form validation
    if (empty($names)) {
        die("<script>alert('Name is empty'); document.location.href = 'register_admin.php';</script>");
    }
    /*
    if (empty($reg_number)) {
        die("<script>alert('Registration Number is empty'); document.location.href = 'signup.php';</script>");
    }
    */
    if (empty($email)) {
        die("<script>alert('Email is empty'); document.location.href = 'register_admin.php';</script>");
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("<script>alert('Invalid email address'); document.location.href = 'register_admin.php';</script>");
    }
    
   
    // Check if terms and conditions are accepted
    /*
    if ($terms !== 1) {
        die("<script>alert('You must accept the Terms and Conditions'); document.location.href = 'sign-up.php';</script>");
    }
    */

    // Handle profile image upload
    $image = null;
    if (!empty($_FILES['image']['name'][0])) {
        $folder = "images/profile_images";
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
        $image = $imageOld;
    }

    //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $date = date("d, M Y");
    // Corrected SQL statement
   $sql = $mysqli->prepare("UPDATE admin_sign_up SET username = ?, reg_name = ?, email = ?, phone = ?, image = ? WHERE id = ?");


    if ($sql === false) {
        die("Error preparing statement: " . $mysqli->error);
    }

    // Bind the parameters
    $sql->bind_param("ssssss", $names, $reg_number, $email, $phone, $image, $id);

    // Execute the query
    if (!$sql->execute()) {
        die("<script>alert('Error during registration'); document.location.href = 'sign-up.php';</script>");
    } else {
        // Send confirmation email to admin
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
            
            
            $OTP = mt_rand(100000, 999999);
            //echo $otp;



            // Content
            $mail->isHTML(true);                                      
            $mail->Subject = 'Admin profile update';
            /* <p>You have successfully been registered as an Admin of Evoting System group 24, verify your regristration number with this <b>OTP: ".$OTP."</b> on login </p>
            */
            $mail->Body    = "
                <h4>Admin profile update Registered:</h4><br>
                 <p>Hello ".$names." your profile has succssfully been registered .  </p>
                 
                <p><strong>Name:</strong> $names</p><br>
                <p><strong>Email:</strong> $email</p><br>
                <p><strong>Phone:</strong> $phone</p><br>
                <p><strong>Profile Image:</strong> <img src='images/profile_images/$image' width='100' height='100'></p><br>
                <p>Date of Registration: $date</p><br>
               
            ";

            // Send the email
            if ($mail->send()) {
                echo "<script>alert('Admin registration for ".$names." successfull'); document.location.href = 'manage_admins.php';</script>";
            } else {
                echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>




