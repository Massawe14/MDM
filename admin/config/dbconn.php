<?php 

  $host = "localhost"; 
  $username = "root";
  $password = "";
  $db = "mdm";

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