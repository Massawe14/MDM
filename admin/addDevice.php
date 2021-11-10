<?php
  include('authentication.php');
  include('config/dbconn.php');
  
  include('includes/header.php');
  include('includes/topbar.php');
  include('includes/sidebar.php');
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
              <li class="breadcrumb-item active">Add Device</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
  <!-- /.content-header -->

  <section class="content mt-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php include('message.php'); ?>
          <div class="card">
            <div class="card-header">
              <h4>
                Add Device
              </h4>
            </div>
            <div class="card-body">
              <form action="code.php" method="POST">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Device ID</label>
                    <?php 
                      $query = "SELECT * FROM session_logs";
                      $result = mysqli_query($conn, $query);

                      if (mysqli_num_rows($result) > 0) {
                        ?>
                          <select name="device_id" class="form-control">
                            <?php foreach ($result as $row) { ?>
                              <option value="<?= $row['device_id'] ?>"><?= $row['device_id'] ?></option>
                            <?php } ?>
                          </select>
                        <?php
                      } 
                    ?>
                  </div>
                  <div class="form-group">
                    <label for=""> Device Name </label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Device Name" required/>
                  </div>
                </div>
                <div class="modal-footer">
                  <a href="index.php" class="btn btn-secondary">BACK</a>
                  <button type="submit" name="addDevice" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include('includes/script.php'); ?>
<?php include('includes/footer.php'); ?>