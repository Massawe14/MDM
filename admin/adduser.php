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
              <li class="breadcrumb-item active">Add Users</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <form action="code.php" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">First Name</label>
              <input type="text" class="form-control" name="firstname" id="firstname" placeholder="First Name" required/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for=""> Last Name </label>
              <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Last Name" required/>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for=""> UserName </label>
          <input type="text" class="form-control" name="username" id="username" placeholder="Username" required/>
        </div>
        <div class="form-group">
          <label for=""> Email </label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Email"required/>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for=""> Password </label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Password" required />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for=""> Confirm Password </label>
              <input type="password" class="form-control" name="confirmpassword" id="password" placeholder="Confirm Password" required />
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for=""> Image </label>
          <input type="file" class="form-control" name="image" id="image" placeholder="Image" required/>
        </div>
        </div>
        <div class="modal-footer">
          <a href="index.php" class="btn btn-secondary">BACK</a>
          <button type="submit" name="adduser" class="btn btn-primary">Save</button>
        </div>
      </form>
  </div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>