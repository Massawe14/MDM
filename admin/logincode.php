<?php 
  session_start();
  include('config/dbconn.php');

  if (isset($_POST['loginbtn'])) {
  	$username = trim($_POST['username']);
  	$password = trim($_POST['password']);

    $query = "SELECT * FROM admin WHERE username='$username' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $numRows = mysqli_num_rows($result);

    if ($numRows == 1) {

      $row = mysqli_fetch_assoc($result);
      if (password_verify($password, $row['password_hash'])) {

        $admin_id = $row['sn'];
        $admin_firstname = $row['first_name'];
        $admin_lastname = $row['last_name'];
        $admin_username = $row['username'];
        $admin_email = $row['email'];
        $admin_password = $row['password_hash'];
        $role_as = $row['role_as'];

        $_SESSION['auth'] = "$role_as";
        $_SESSION['auth_admin'] = [
          'admin_id'=>$admin_id,
          'admin_firstname'=>$admin_firstname,
          'admin_lastname'=>$admin_lastname,
          'admin_username'=>$admin_username,
          'admin_email'=>$admin_email,
          'admin_password'=>$admin_password
        ];

        if ($role_as == "SuperAdmin") {
          $_SESSION['status'] = "Logged In Successfully";
          header('Location: index.php');
        }
        elseif ($role_as == "Admin") {
          $_SESSION['status'] = "Logged In Successfully";
          header('Location: admin.php');
        }
        else{
          $_SESSION['status'] = "You are not Authorized";
          header('Location: login.php');
        }
      }
      else{
        $_SESSION['status'] = "Invalid Username or Password";
        header('Location: login.php');
      }
    }
    else{
      $_SESSION['status'] = "You are not Authorized as Admin";
      header('Location: login.php');
    }
  }
  else{
  	$_SESSION['status'] = "Access Denied";
  	header('Location: login.php');
  }
?>