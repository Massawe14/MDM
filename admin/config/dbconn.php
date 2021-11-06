<?php 

  $host = "localhost"; 
  $username = "root"; // imccotz_mdm_service_admin
  $password = ""; // imperialinnovations2021
  $db = "mdm"; // imccotz_mdm_service

  // Connection
  $conn = mysqli_connect("$host","$username","$password","$db");

  // Check connection
  if (!$conn) {
  	header("Location: errors/db.php");
  	die();
  	// die(mysqli_connect_error($conn));
  }
  // else{
  // 	echo "Database Connected.!";
  // }

?>