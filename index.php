<?php  
  session_start();
?>

<h5>
	Home page for User
</h5>

<?php  
  if (isset($_SESSION['status'])) {
  	echo $_SESSION['status'];
  	unset($_SESSION['status']);
  }
?>