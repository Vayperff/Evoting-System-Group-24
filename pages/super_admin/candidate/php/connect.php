<?php
$localhost = htmlspecialchars("localhost",ENT_QUOTES,'UTF-8');
$root = htmlspecialchars("skyratesipifalls_MorganEmmanuel",ENT_QUOTES,'UTF-8');
$password = htmlspecialchars("Secret@123$$",ENT_QUOTES,'UTF-8');
$database = htmlspecialchars("skyratesipifalls_voting_system",ENT_QUOTES,'UTF-8');


$mysqli = new mysqli( $localhost, 
                      $root,
                      $password,
                      $database);
                     
    
  if(!$mysqli) {
      die("Error: Server Connection Failed");
  }

?>