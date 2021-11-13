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
            <li class="breadcrumb-item active">Edit Main Session</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
   
  <section class="content">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Edit Main Session</h3>
              <a href="main-session.php" class="btn btn-primary btn-sm float-right">BACK</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <form action="code.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                      <?php
                        if (isset($_GET['sn'])) {
                          $sn = $_GET['sn'];
                          $query = "SELECT * FROM main_sessions WHERE sn='$sn' LIMIT 1";
                          $result = mysqli_query($conn, $query);

                          if (mysqli_num_rows($result) > 0) {
                            foreach ($result as $row) {
                              ?>
                                <input type="hidden" name="sn" value="<?php echo $row['sn']; ?>"/>
                                <div class="form-group">
                                  <label for="">Session ID</label>
                                  <input type="text" class="form-control" name="session_id" id="session_id" placeholder="Session ID" required value="<?php echo $row['session_id']; ?>" />
                                </div>
                                <div class="form-group">
                                  <label for="">Session Name</label>
                                  <input type="text" class="form-control" name="name" id="name" placeholder="Session Name" required value="<?php echo $row['name']; ?>" />
                                </div>
                              <?php
                            }
                          }
                        }
                        else{
                          echo "<h4>No Record Found.!</h4>";
                        }
                      ?>
                   </div>
                   <div class="modal-footer">
                      <button type="submit" name="updateMainSession" class="btn btn-info">Update</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>