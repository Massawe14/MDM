<?php 
  session_start();
  include('config/dbconn.php');

  if (isset($_POST['login_btn'])) {
  	$username = $_POST['username'];
  	$password = $_POST['password'];

  	$query = "SELECT * FROM admin WHERE username='$username' AND password_hash='$password' LIMIT 1";
  	$result = mysqli_query($conn, $query);

  	if (mysqli_num_rows($result) > 0) {
  		foreach ($result as $row) {
  			$admin_id = $row['sn'];
  			$admin_firstname = $row['first_name'];
  			$admin_lastname = $row['last_name'];
  			$admin_username = $row['username'];
  			$admin_email = $row['email'];
  			$admin_password = $row['password_hash'];
        $role_as = $row['role_as'];
  		}

  		$_SESSION['auth'] = "$role_as";
  		$_SESSION['auth_admin'] = [
  			'admin_id'=>$admin_id,
  			'admin_firstname'=>$admin_firstname,
  			'admin_lastname'=>$admin_lastname,
  			'admin_username'=>$admin_username,
  			'admin_email'=>$admin_email,
  			'admin_password'=>$admin_password
  		];

  		$_SESSION['status'] = "Logged In Successfully";
  	    header('Location: index.php');
  	}
  	else{
  		$_SESSION['status'] = "Invalid Username or Password";
  	    header('Location: login.php');
  	}
  }
  else{
  	$_SESSION['status'] = "Access Denied";
  	header('Location: login.php');
  }

?>