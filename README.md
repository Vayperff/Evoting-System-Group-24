**Evoting System Group 24**

This is a PHP-based voting system with four user roles and a MySQL database backend. It provides a structured voting process for institutions or organizations, complete with user authentication, email notifications, and multiple role interfaces.


1 ** System Interfaces**

The system consists of four distinct interfaces, each located in a specific folder within the project:

1 **Admin Interface**  
  Path: pages/

 2 **Super Admin Interface**  
  Path: pages/super_admin/

 3 **Candidate Interface**  
  Path: pages/candidate/
  
4 **Voter/Student Interface**  
  Path: pages/student/

Each interface has its own responsibilities, including managing elections, registering candidates, casting votes, and overseeing system operations.


** Requirements**

- **PHP Version:** 7.x or 8.x
- **Database Server:** MySQL (via XAMPP or similar)
- **Web Server:** Apache (recommended via XAMPP)


** Project Structure**

project-root/
│
├── pages/ # Admin interface
│ └── php/ # Server-side logic (DB operations, email, etc.)
│
├── pages/super_admin/ # Super Admin interface
│ └── php/
│
├── pages/candidate/ # Candidate interface
│ └── php/
│
├── pages/student/ # Voter/Student interface
│ └── php/
│
├── database sql file/ # SQL file for creating database structure
│ └── voting_system.sql


2. Start XAMPP
Ensure Apache and MySQL are running.

3. Create the Database
Open http://localhost/phpmyadmin

Create a database named: voting_system

Click the Import tab.

Upload and import voting_system.sql from the database sql file/ folder.

 Database Connection
Each interface has a connect.php file located in its php/ folder. Example:


<?php
$localhost = htmlspecialchars("localhost", ENT_QUOTES, 'UTF-8');
$root = htmlspecialchars("root", ENT_QUOTES, 'UTF-8');
$password = htmlspecialchars("", ENT_QUOTES, 'UTF-8');
$database = htmlspecialchars("voting_system", ENT_QUOTES, 'UTF-8');

$mysqli = new mysqli($localhost, $root, $password, $database);

if (!$mysqli) {
    die("Error: Server Connection Failed");
}
?>


🔄 Note: If you use a different database name, update all connect.php files across the interfaces to match your custom DB name.




Frontend Customization
Most frontend pages are located outside the php/ folders.

These files are .php, but mainly consist of HTML, CSS, JavaScript, and embedded PHP for dynamic data.

You are free to:

Modify styles (CSS)

Replace or upgrade Bootstrap

Adjust layout and templates as needed

📧 Email Functionality (SMTP)
The system uses PHPMailer for sending emails (e.g., registration, notifications, etc.).

Each php/ folder (across all interfaces) may include files that send emails using SMTP.

Example Configuration:

$mail->isSMTP();
$mail->Host = 'mail.skyratesipifalls.com';
$mail->SMTPAuth = true;
$mail->Username = 'info@skyratesipifalls.com';
$mail->Password = 'Secret@123$$';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port = 465;


To Use Your Own SMTP:
Replace Host, Username, and Password with your SMTP details (e.g., from Gmail, your hosting provider, etc.)

Update these values in all php files that send email:

Example: pages/php/add_election.php

Candidates, Admins, Super Admins, and Students have different mail-related files

**Important:** **Without correct SMTP credentials, email functionality will not work.**


** Summary**
PHP-based voting system with Admin, Super Admin, Candidate, and Student interfaces

MySQL backend with full importable schema (voting_system.sql)

Email notifications via PHPMailer with configurable SMTP

Clean separation of HTML/CSS and server-side PHP logic

Ready for customization and deployment on XAMPP


