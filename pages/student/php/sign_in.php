<?php 
require __DIR__ ."/connect.php";
$is_invalid = false;
if($_SERVER["REQUEST_METHOD"] === "POST") {
	if(isset($_POST['login'])) {
		$reg_email = $mysqli->real_escape_string(filter_var($_POST["reg_email"],FILTER_SANITIZE_STRING));
		$password = $mysqli->real_escape_string(filter_var($_POST["password"],FILTER_SANITIZE_STRING));

		/*if(strlen($reg_email) > 30) {
			die("Error: email address longer than 30 characters");
		}*/
		
	


		
		
		
		

		$sql = $mysqli->prepare("SELECT * FROM student_sign_up WHERE deleted = 0  AND reg_name = ?");
		$sql->bind_param("s",$reg_email);
		$sql->execute();
		$resqsl = $sql->get_result();
		$fetch = $resqsl->fetch_object();

		if($fetch) {
			if(password_verify($password,$fetch->password)) {
				session_start();
				session_regenerate_id();
				$_SESSION['student_id'] = filter_var($fetch->id,FILTER_SANITIZE_NUMBER_INT);
				
				header("location: dashboard.php");
			}
		}
		$is_invalid = true;
	}
}



?>

