<?php 

  include('authentication.php');
  
  include('includes/header.php');
  include('includes/topbar.php');
  include('includes/sidebar.php');
  include('config/dbconn.php');
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <form action="code.php" method="POST">
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Username </label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Old Password </label>
                <input type="password" class="form-control" name="old_password" id="oldpassword" placeholder="Old Password" required />
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">New Password </label>
                <input type="password" class="form-control" name="new_password" id="newpassword" placeholder="New Password" required />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for=""> Confirm Password </label>
                <input type="password" class="form-control" name="confirm_password" id="c_password" placeholder="Confirm Password" required />
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <a href="index.php" class="btn btn-secondary">BACK</a>
          <button type="submit" name="changePassword" class="btn btn-primary">Change</button>
        </div>
      </form>
  </div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>