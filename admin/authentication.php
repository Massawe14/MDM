<?php  
  session_start();
  // header("Refresh: 60");

  if (!isset($_SESSION['auth'])) {
  	$_SESSION['auth_status'] = "Login to Access Dashboard";
  	header('Location: login.php');
    exit(0);
  }
  else{
    if ($_SESSION['auth'] == "SuperAdmin") {
      // 
    }
    elseif ($_SESSION['auth'] == "Admin") {
      // 
    }
    else{
      $_SESSION['status'] = "You are not Authorized as ADMIN";
      header('Location: login.php');
      exit(0);
    }
  }

?>