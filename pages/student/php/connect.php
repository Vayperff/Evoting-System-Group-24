<?php
$localhost = htmlspecialchars("localhost",ENT_QUOTES,'UTF-8');
$root = htmlspecialchars("root",ENT_QUOTES,'UTF-8');
$password = htmlspecialchars("",ENT_QUOTES,'UTF-8');
$database = htmlspecialchars("voting_system",ENT_QUOTES,'UTF-8');


$mysqli = new mysqli( $localhost, 
                      $root,
                      $password,
                      $database);
                     
    
  if(!$mysqli) {
      die("Error: Server Connection Failed");
  }

?>
