<?php  
  session_start();

  if (!isset($_SESSION['auth'])) {
  	$_SESSION['auth_status'] = "Login to Access Dashboard";
  	header('Location: login.php');
    exit(0);
  }
  else{
    if ($_SESSION['auth'] == "SuperAdmin") {
      // code...
    }
    else{
      $_SESSION['status'] = "You are not Authorized as ADMIN";
      header('Location: login.php');
      exit(0);
    }
  }

?>