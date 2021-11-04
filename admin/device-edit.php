<?php
  include('authentication.php');
  include('config/dbconn.php');
  
  include('includes/header.php');
  include('includes/topbar.php');
  include('includes/sidebar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <section class="content mt-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php include('message.php'); ?>
          <div class="card">
            <div class="card-header">
              <h4>
                Edit Device
                <a href="device.php" class="btn btn-primary float-right">BACK</a>
              </h4>
            </div>
            <div class="card-body">
              <form action="code.php" method="POST">
                <?php 
                  if (isset($_GET['id'])) {
                    $device_id = $_GET['id'];
                    $query = "SELECT * FROM device WHERE id='$device_id'";
                    $result = mysqli_query($conn, $query);
                    foreach ($result as $row) :
                    ?>
                      <input type="hidden" name="device_id" value="<?= $row['id']; ?>">
                      
                      <div class="modal-body">
                        <div class="form-group">
                          <label for="">Device ID</label>
                          <input type="text" name="dev_id" value="<?= $row['dev_id'] ?>" class="form-control" required>
                        </div>
                        <div class="form-group">
                          <label>Assign User</label>
                          <?php 
                            $query = "SELECT * FROM user";
                            $result = mysqli_query($conn, $query);

                            if (mysqli_num_rows($result) > 0) {
                              ?>
                                <select name="dev_user" class="form-control">
                                  <?php foreach ($result as $key) { ?>
                                    <option value="<?= $key['username'] ?>"><?= $key['username'] ?></option>
                                  <?php } ?>
                                </select>
                              <?php
                            } 
                          ?>
                        </div>
                        <!-- <div class="form-group">
                          <label for="">Status</label>
                          <input type="checkbox" name="dev_status" <?= $row['dev_status'] == "1" ? 'checked':''; ?> />Status
                        </div> -->
                      </div>
                      <div class="modal-footer">
                        <a href="device.php" class="btn btn-secondary">BACK</a>
                        <button type="submit" name="updateDevice" class="btn btn-primary">Update</button>
                      </div>
                    <?php
                    endforeach;
                   }
                   else{
                    echo "No ID Found";
                   } 
                ?>
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