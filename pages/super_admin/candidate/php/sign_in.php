<?php 
require __DIR__ ."/connect.php";
$is_invalid = false;


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


if($_SERVER["REQUEST_METHOD"] === "POST") {
	if(isset($_POST['login'])) {
		$reg_email = $mysqli->real_escape_string(filter_var($_POST["reg_email"],FILTER_SANITIZE_EMAIL));
		//$password = $mysqli->real_escape_string(filter_var($_POST["password"],FILTER_SANITIZE_STRING));

		if(strlen($reg_email) > 50) {
			die("Error: email address longer than 30 characters");
		}
		

		$sql = $mysqli->prepare("SELECT * FROM candidates WHERE email = ?");
		$sql->bind_param("s",$reg_email);
		$sql->execute();
		$resqsl = $sql->get_result();
		$fetch = $resqsl->fetch_object();

		if($fetch) {
		    
		    session_start();
			session_regenerate_id();
		    
		    $unique = substr(md5(uniqid(microtime(), true)), 0, 6);
		    $_SESSION['code'] = strtoupper(substr(md5(uniqid(microtime(), true)), 0, 6));
		    $_SESSION['email'] = $reg_email;
		    $_SESSION['candidate_id'] = filter_var($fetch->id,FILTER_SANITIZE_NUMBER_INT);
		    
		    
		    // Send confirmation email to admin
        $mail = new PHPMailer(true);
        $candidate_name = htmlspecialchars($fetch->candidate_name,ENT_QUOTES,'UTF-8');
        
        $date = date("d, M Y ");
        
        try {
            // Server settings
            $mail->isSMTP();                                          
            $mail->Host = 'mail.skyratesipifalls.com';                 
            $mail->SMTPAuth = true;                                    
            $mail->Username = 'info@skyratesipifalls.com';             
            $mail->Password = 'Secret@123$$';                          
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          
            $mail->Port = 465;                                        

            // Recipients
            $mail->setFrom('info@skyratesipifalls.com', 'Evoting System Group 24');
            $mail->addAddress('emmymorgan1278@gmail.com');
            $mail->addAddress($reg_email); 
            
            
            $OTP = mt_rand(100000, 999999);
            //echo $otp;



            // Content
            $mail->isHTML(true);                                      
            $mail->Subject = 'Login Code';
            /* <p>You have successfully been registered as an Admin of Evoting System group 24, verify your regristration number with this <b>OTP: ".$OTP."</b> on login </p>
            */
            $mail->Body    = "
                <h4>LOGIN CODE</h4><br>
                 <p>
                 Hello ".$candidate_name.", <br>
                 Use this code to login into your dashboard ".$_SESSION['code']."</p>
                 
                <p>Date of Registration: $date</p><br>
               
            ";

            // Send the email
            if ($mail->send()) {
                echo "<script>alert('A code has been sent to your email address enter to it to login'); document.location.href = 'enter_code.php';</script>";
            } else {
                echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
		    
		    /*
			if(password_verify($password,$fetch->password)) {
				session_start();
				session_regenerate_id();
				$_SESSION['candidate_id'] = filter_var($fetch->id,FILTER_SANITIZE_NUMBER_INT);
				
				header("location: dashboard.php");
			}*/
		}
		$is_invalid = true;
	}
}



?>

