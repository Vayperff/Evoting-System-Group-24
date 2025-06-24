
<?php
require __DIR__."/connect.php";
// Include PHPMailer files from your directory
require 'PHPMailer-6.9.1/src/PHPMailer.php';
require 'PHPMailer-6.9.1/src/SMTP.php';
require 'PHPMailer-6.9.1/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['send_message'])) {
    // Collect form data
    $name = htmlspecialchars($_POST['fullnames']);
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $phone = htmlspecialchars($_POST['tel']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    $date = date("d, F Y");
    if (!$email) {
        echo "Invalid email format!";
        exit;
    }

    // Create a new PHPMailer instance
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
        $mail->setFrom('info@skyratesipifalls.com', $name);       // Sender's email address and name
        $mail->addAddress('patrickmusobo15@gmail.com');           // Add recipient's email addresspatrickmusobo15@gmail.com

        // Content
        $mail->isHTML(true);                                      // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = "
            <h4>New Message From</h4><br>
            <p><strong>Name:</strong> $name</p><br>
            <p><strong>Email:</strong> $email</p><br>
            <p><strong>Phone:</strong> $phone</p><br>
            <p><strong>Message:</strong><br>$message</p><br><br>
            <p>Date sent: $date </p>
        ";

        // Send the email
        if ($mail->send()) {
            $date = date("d, M Y");
            $sql = $mysqli->prepare("INSERT INTO messages(fullnames,email,phone_contact,subject,messages,date_format) VALUES (?,?,?,?,?,?)");
            $sql->bind_param("ssssss",$name,$email,$phone,$subject,$message,$date);
            if(!$sql->execute()) { 
                die("Error");
            }
            else {
            printf("<script>alert('Message has been sent successfully!');
               document.location.href = '';
                </script>");
            }
        } else {
            echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


?>
