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
              <li class="breadcrumb-item active">Users Sessions</li>
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
                Users Session
              </h4>
            </div>
            <div class="card-body">
              <form action="code.php" method="POST">
                <div class="modal-body">
                  <div class="form-group">
                    <label>Session ID</label>
                    <?php 
                      $query = "SELECT * FROM main_sessions";
                      $result = mysqli_query($conn, $query);

                      if (mysqli_num_rows($result) > 0) {
                        ?>
                          <select name="session_id" class="form-control">
                            <?php foreach ($result as $row) { ?>
                              <option value="<?= $row['session_id'] ?>"><?= $row['session_id'] ?></option>
                            <?php } ?>
                          </select>
                        <?php
                      } 
                    ?>
                  </div>
                  <div class="form-group">
                    <label>User ID</label>
                    <?php 
                      $query = "SELECT * FROM users";
                      $result = mysqli_query($conn, $query);

                      if (mysqli_num_rows($result) > 0) {
                        ?>
                          <select name="user_id" class="form-control">
                            <?php foreach ($result as $row) { ?>
                              <option value="<?= $row['username'] ?>"><?= $row['username'] ?></option>
                            <?php } ?>
                          </select>
                        <?php
                      } 
                    ?>
                  </div>
                  <!-- <div class="form-group">
                    <label for="">User ID</label>
                    <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User ID" required/>
                  </div> -->
                  <div class="form-group">
                    <label>Device ID</label>
                    <?php 
                      $query = "SELECT * FROM devices";
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
                </div>
                <div class="modal-footer">
                  <a href="index.php" class="btn btn-secondary">BACK</a>
                  <button type="submit" name="addUserSession" class="btn btn-primary">Save</button>
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