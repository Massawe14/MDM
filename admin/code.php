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
  if (isset($_POST['check_Devicebtn'])) {

    $deviceID = $_POST['dev_id'];

    $checkdevice = "SELECT dev_id FROM device WHERE dev_id='$deviceID'";
    $checkdevice_result = mysqli_query($conn, $checkdevice);

    if (mysqli_num_rows($checkdevice_result) > 0) {
      echo "Device Already Exists";
    }
    else{
      echo "It's Available";
    }
  }

  if (isset($_POST['addDevice'])) {
    $dev_id = $_POST['dev_id'];
    $dev_user = $_POST['dev_user'];
    $dev_status = $_POST['dev_status'] == true ? '1':'0';

    $device_query = "INSERT INTO `device` (`dev_id`, `dev_user`, `dev_status`) VALUES ('$dev_id', '$dev_user', '$dev_status')";
    $device_query_result = mysqli_query($conn, $device_query);

    if ($device_query_result) {
      $_SESSION['status'] = "Device added Successfully";
      header('Location: device.php');
    }
    else{
      $_SESSION['status'] = "Device Insertion Failed";
      header('Location: device.php');
    }
  }

  if (isset($_POST['updateDevice'])) {
    $device_id = $_POST['device_id'];
    $dev_id = $_POST['dev_id'];
    $dev_user = $_POST['dev_user'];
    $dev_status = $_POST['dev_status'] == true ? '1':'0';

    $query = "UPDATE device SET dev_id='$dev_id', dev_user='$dev_user', dev_status='$dev_status' WHERE id='$device_id'";
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

  if (isset($_POST['deleteDevice'])) {
    $device_delete_id = $_POST['delete_dev_id'];

    $query = "DELETE FROM device WHERE id='$device_delete_id'";
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

    if ($password == $confirmpassword) {

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
        $query = "INSERT INTO `admin`(`fname`, `lname`, `username`, `email`, `password`, `role_as`) VALUES ('$firstname', '$lastname', '$username', '$adminemail', '$password', '$role_as')";
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
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $adminemail = $_POST['email'];
    $password = $_POST['password'];
    $role_as = $_POST['role_as'];

    $query = "UPDATE `admin` SET fname='$firstname', lname='$lastname', username='$username', email='$adminemail', password='$password', role_as='$role_as' WHERE id=$id";
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

    $sql = "DELETE FROM admin WHERE id = '$adminid'";
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

    $checkemail = "SELECT email FROM user WHERE email='$useremail'";
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


    $allowed_extension = array('png','jpg','jpeg');
    $file_extension = pathinfo($image, PATHINFO_EXTENSION);

    $filename = time().'.'.$file_extension;

    $check = getimagesize($_FILES["image"]["tmp_name"]);

    if ($password == $confirmpassword) {

       $checkemail = "SELECT email FROM user WHERE email='$useremail'";
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
        $query = "INSERT INTO `user`(`fname`, `lname`, `username`, `email`, `image`, `password`) VALUES ('$firstname', '$lastname', '$username', '$useremail', '$filename', '$password')";
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
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $useremail = $_POST['email'];
    $image = $_FILES['image']['name'];
    $password = $_POST['password'];

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
      $query = "UPDATE `user` SET fname='$firstname', lname='$lastname', username='$username', email='$useremail', image='$filename', password='$password' WHERE id=$id";
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

    $sql = "DELETE FROM user WHERE id = '$userid'";
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

?>