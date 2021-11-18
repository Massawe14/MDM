<?php
  include('authentication.php');
  include('config/dbconn.php');

  if (isset($_POST['logout_btn'])) {
    // session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_admin']);

    $_SESSION['status'] = "Logged out successfully";
    header('Location: login.php');
    exit(0);
  }

  // DEVICE
  if (isset($_POST['addDevice'])) {
    $device_id = $_POST['device_id'];
    $name = $_POST['name'];
    $username = $_POST['username'];

    $query = "INSERT INTO `devices`(`device_id`, `name`, `username`) VALUES ('$device_id', '$name', '$username')";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $_SESSION['status'] = "Device added Successfully";
      header('Location: device.php');
    }
    else{
      $_SESSION['status'] = "Device Insertion Failed";
      header('Location: device.php');
    }
  }

  if (isset($_POST['updateDevice'])) {
    $sn = $_POST['sn'];
    $device_id = $_POST['device_id'];
    $name = $_POST['name'];
    $username = $_POST['username'];

    $query = "UPDATE devices SET device_id='$device_id', name='$name', username='$username' WHERE sn='$sn'";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $_SESSION['status'] = "Device Updated Successfully";
      header('Location: device.php');
    }
    else{
      $_SESSION['status'] = "Device Updating Failed";
      header('Location: device.php');
    }
  }

  if (isset($_POST['DeleteDevicebtn'])) {
    $device_delete_id = $_POST['delete_device'];

    $query = "DELETE FROM devices WHERE sn='$device_delete_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $_SESSION['status'] = "Device Deleted Successfully";
      header('Location: device.php');
    }
    else{
      $_SESSION['status'] = "Device Deleting Failed";
      header('Location: device.php');
    }
  }

  // ADMIN
  if (isset($_POST['check_Emailbtn'])) {

    $adminemail = $_POST['email'];

    $checkemail = "SELECT email FROM admin WHERE email='$adminemail'";
    $checkemail_result = mysqli_query($conn, $checkemail);

    if (mysqli_num_rows($checkemail_result) > 0) {
      echo "Email Already Exists";
    }
    else{
      echo "It's Available";
    }
  }

  if (isset($_POST['addAdmin'])) {
    // there are no errors so let's get data from the form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $adminemail = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    $confirmpassword = $_POST['confirmpassword'];
    
    // password encryption
    $password_encrypt = password_hash($password, PASSWORD_DEFAULT);

    if (password_verify($confirmpassword, $password_encrypt)) {

       $checkemail = "SELECT email FROM admin WHERE email='$adminemail'";
       $checkemail_result = mysqli_query($conn, $checkemail);

       if (mysqli_num_rows($checkemail_result) > 0) {
         // Taken - Already Exists
         $_SESSION['status'] = "Email Already Exists";
         header('Location: registeradmin.php');
         exit;
       }
       else{
        // Now we have collected the form data in variables
        // Let's insert them to the table
        $query = "INSERT INTO `admin`(`first_name`, `last_name`, `username`, `email`, `password_hash`, `role_as`) VALUES ('$firstname', '$lastname', '$username', '$adminemail', '$password_encrypt', '$role_as')";
        $result = mysqli_query($conn, $query); 

        if ($result) {
          $_SESSION['status'] = "Admin Added Successfully";
          header('Location: registeradmin.php');
        }
        else{
          $_SESSION['status'] = "Admin Registration Failed";
          header('Location: registeradmin.php');
        }
      }
    }
    else{
      $_SESSION['status'] = "Password and Confirm Password does not match";
      header('Location: registeradmin.php');
    }
  }

  if (isset($_POST['updateAdmin'])) {
    $sn = $_POST['sn'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $adminemail = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];
    
    // password encryption
    $password_encrypt = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE `admin` SET first_name='$firstname', last_name='$lastname', username='$username', email='$adminemail', password_hash='$password_encrypt', role_as='$role_as' WHERE sn='$sn'";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $_SESSION['status'] = "Admin Updated Successfully";
      header("Location: registeradmin.php");
    }
    else{
      $_SESSION['status'] = "Admin Updating Failed";
      header("Location: registeradmin.php");
    }
  }

  if (isset($_POST['DeleteAdminbtn'])) {
    $adminid = $_POST['delete_admin'];

    $sql = "DELETE FROM admin WHERE sn = '$adminid'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      $_SESSION['status'] = "Admin Deleted Successfully";
      header("Location: registeradmin.php");
    }
    else{
      $_SESSION['status'] = "Admin Deleting Failed";
      header("Location: registeradmin.php");
    }
  }

  // USER
  if (isset($_POST['check_Emailbtn'])) {

    $useremail = $_POST['email'];

    $checkemail = "SELECT email FROM users WHERE email='$useremail'";
    $checkemail_result = mysqli_query($conn, $checkemail);

    if (mysqli_num_rows($checkemail_result) > 0) {
      echo "Email Already Exists";
    }
    else{
      echo "It's Available";
    }
  }

  if (isset($_POST['adduser'])) {
    // there are no errors so let's get data from the form
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $useremail = $_POST['email'];
    $image = $_FILES['image']['name'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    // password encryption
    $password_encrypt = password_hash($password, PASSWORD_DEFAULT);

    $allowed_extension = array('png','jpg','jpeg');
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);

    $filename = time().'.'.$file_extension;

    $check = getimagesize($_FILES["image"]["tmp_name"]);

    if (password_verify($confirmpassword, $password_encrypt)) {

       $checkemail = "SELECT email FROM users WHERE email='$useremail'";
       $checkemail_result = mysqli_query($conn, $checkemail);

       if (mysqli_num_rows($checkemail_result) > 0) {
         // Taken - Already Exists
         $_SESSION['status'] = "Email Already Exists";
         header('Location: registered.php');
         exit(0);
       }
       elseif ($check == false) {
         $_SESSION['status'] = "File is not an image.";
         header('Location: registered.php');
         exit(0);
       }
       elseif (file_exists($filename)) {
         $_SESSION['status'] = "Sorry, file already exists.";
         header('Location: registered.php');
         exit(0);
       }
       elseif (!in_array($file_extension, $allowed_extension)) {
         $_SESSION['status'] = "You are allowed with only jpg, png and jpeg Image";
         header('Location: registered.php');
         exit(0);
       }
       // elseif ($_FILES["image"]["size"] > 500000) {
       //   $_SESSION['status'] = "Sorry, your file is too large.";
       //   header('Location: registered.php');
       //   exit(0);
       // }
       else{
        // Now we have collected the form data in variables
        // Let's insert them to the table
        $query = "INSERT INTO `users`(`first_name`, `last_name`, `username`, `email`, `image`, `password_hash`) VALUES ('$firstname', '$lastname', '$username', '$useremail', '$filename', '$password_encrypt')";
        $result = mysqli_query($conn, $query); 

        if ($result) {
          move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/images/'.$filename);
          $_SESSION['status'] = "User Added Successfully";
          header('Location: registered.php');
          exit(0);
        }
        else{
          $_SESSION['status'] = "User Registration Failed";
          header('Location: registered.php');
          exit(0);
        }
      }
    }
    else{
      $_SESSION['status'] = "Password and Confirm Password does not match";
      header('Location: registered.php');
    }
  }

  if (isset($_POST['updateUser'])) {
    $sn = $_POST['sn'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $useremail = $_POST['email'];
    $image = $_FILES['image']['name'];
    $password = $_POST['password'];

    // password encryption
    $password_encrypt = password_hash($password, PASSWORD_DEFAULT);

    $allowed_extension = array('png','jpg','jpeg');
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);

    $filename = time().'.'.$file_extension;

    $check = getimagesize($_FILES["image"]["tmp_name"]);

    if ($check == false) {
      $_SESSION['status'] = "File is not an image.";
      header('Location: registered.php');
      exit(0);
    }
    elseif (file_exists($filename)) {
      $_SESSION['status'] = "Sorry, file already exists.";
      header('Location: registered.php');
      exit(0);
    }
    elseif (!in_array($file_extension, $allowed_extension)) {
      $_SESSION['status'] = "You are allowed with only jpg, png and jpeg Image";
      header('Location: registered.php');
      exit(0);
    }
    // elseif ($_FILES["image"]["size"] > 500000) {
    //   $_SESSION['status'] = "Sorry, your file is too large.";
    //   header('Location: registered.php');
    //   exit(0);
    // }
    else{
      $query = "UPDATE `users` SET first_name='$firstname', last_name='$lastname', username='$username', email='$useremail', image='$filename', password_hash='$password_encrypt' WHERE sn='$sn'";
      $result = mysqli_query($conn, $query);

      if ($result) {
        move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/images/'.$filename);
        $_SESSION['status'] = "User Updated Successfully";
        header("Location: registered.php");
        exit(0);
      }
      else{
        $_SESSION['status'] = "User Updating Failed";
        header("Location: registered.php");
        exit(0);
      }
    }
  }

  if (isset($_POST['DeleteUserbtn'])) {
    $userid = $_POST['delete_user'];

    $sql = "DELETE FROM users WHERE sn = '$userid'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
      $_SESSION['status'] = "User Deleted Successfully";
      header("Location: registered.php");
    }
    else{
      $_SESSION['status'] = "User Deleting Failed";
      header("Location: registered.php");
    }
  }

  // DELETE SESSION LOGS
  if (isset($_POST['deleteSessionLogs'])) {
    $sessionlogs_delete_sn = $_POST['delete_session_sn'];

    $query = "DELETE FROM session_logs WHERE sn='$sessionlogs_delete_sn'";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $_SESSION['status'] = "Session Logs Deleted Successfully";
      header('Location: session-logs.php');
    }
    else{
      $_SESSION['status'] = "Session Logs Deleting Failed";
      header('Location: session-logs.php');
    }
  }

  // MAIN SESSION
  if (isset($_POST['addSession'])) {
    $session_id = $_POST['session_id'];
    $name = $_POST['name'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $query = "INSERT INTO `main_sessions` (`session_id`, `name`, `start_time`, `end_time`) VALUES ('$session_id', '$name', '$start_time', '$end_time')";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $_SESSION['status'] = "Session added Successfully";
      header('Location: main-session.php');
    }
    else{
      $_SESSION['status'] = "Session Insertion Failed";
      header('Location: main-session.php');
    }
  }

  if (isset($_POST['updateMainSession'])) {
    $sn = $_POST['sn'];
    $session_id = $_POST['session_id'];
    $name = $_POST['name'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];

    $query = "UPDATE main_sessions SET session_id='$session_id', name='$name', start_time='$start_time', end_time='$end_time' WHERE sn='$sn'";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $_SESSION['status'] = "Session Updated Successfully";
      header('Location: main-session.php');
    }
    else{
      $_SESSION['status'] = "Session Updating Failed";
      header('Location: main-session.php');
    }
  }

  if (isset($_POST['deleteMainSessionUsers'])) {
    $mainsession_delete_id = $_POST['delete_mainsession_id'];

    $query = "DELETE FROM main_sessions WHERE sn='$mainsession_delete_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $_SESSION['status'] = "Session Deleted Successfully";
      header('Location: main-session.php');
    }
    else{
      $_SESSION['status'] = "Session Deleting Failed";
      header('Location: main-session.php');
    }
  }

  // SESSION USERS
  if (isset($_POST['addUserSession'])) {
    $session_id = $_POST['session_id'];
    $user_id = $_POST['user_id'];
    $device_id = $_POST['device_id'];

    $device_query = "INSERT INTO `session_users` (`session_id`, `user_id`, `device_id`) VALUES ('$session_id', '$user_id', '$device_id')";
    $device_query_result = mysqli_query($conn, $device_query);

    if ($device_query_result) {
      $_SESSION['status'] = "Session added Successfully";
      header('Location: session-users.php');
    }
    else{
      $_SESSION['status'] = "Session Insertion Failed";
      header('Location: session-users.php');
    }
  }

  if (isset($_POST['deleteSessionUsers'])) {
    $sessionuser_delete_id = $_POST['delete_sessionusers_id'];

    $query = "DELETE FROM session_users WHERE sn='$sessionuser_delete_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $_SESSION['status'] = "Session User Deleted Successfully";
      header('Location: session-users.php');
    }
    else{
      $_SESSION['status'] = "Session User Deleting Failed";
      header('Location: session-users.php');
    }
  }

  if (isset($_POST['updateUserSession'])) {
    $sn = $_POST['sn'];
    $session_id = $_POST['session_id'];
    $user_id = $_POST['user_id'];
    $device_id = $_POST['device_id'];

    $query = "UPDATE session_users SET session_id='$session_id', user_id='$user_id', device_id='$device_id' WHERE sn='$sn";
    $result = mysqli_query($conn, $query);

    if ($result) {
      $_SESSION['status'] = "User Session Updated Successfully";
      header('Location: session-users.php');
    }
    else{
      $_SESSION['status'] = "User Session Updating Failed";
      header('Location: session-users.php');
    }
  }

  // CHANGE PASSWORD
  // if (isset($_POST['changePassword'])) {

  //   // there are no errors so let's get data from the form
  //   $username = trim($_POST['username']);
  //   $old_password = trim($_POST['old_password']);
  //   $new_password = trim($_POST['new_password']);
  //   $confirm_password = trim($_POST['confirm_password']);

  //   // password encryption
  //   $password_encrypt = password_hash($new_password, PASSWORD_DEFAULT);

  //   $query = "SELECT * FROM admin WHERE username='$username' LIMIT 1";
  //   $result = mysqli_query($conn, $query);
  //   $row = mysqli_fetch_assoc($result);

  //   if (password_verify($old_password, $row['password_hash'])) {

  //     if (password_verify($confirmpassword, $password_encrypt)) {
  //       $change = "UPDATE `admin` SET password_hash='$password_encrypt' WHERE username='$username'";
  //       $result_change = mysqli_query($conn, $change);

  //       if ($result_change) {
  //         $_SESSION['status'] = "Password Changed Successfully";
  //         header("Location: change-password.php");
  //       }
  //       else{
  //         $_SESSION['status'] = "Password Changing Failed";
  //         header("Location: change-password.php");
  //       }
  //     }
  //     else{
  //       $_SESSION['status'] = "Password and Confirm Password does not match";
  //       header("Location: change-password.php");
  //     }
  //   }
  //   else{
  //     $_SESSION['status'] = "Incorrect Old Password";
  //     header("Location: change-password.php");
  //   }
  // }
?>
        