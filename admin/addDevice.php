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
                Add Device
              </h4>
            </div>
            <div class="card-body">
              <form action="code.php" method="POST">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="">Device ID</label>
                    <span class="device_error text-danger ml-2"></span>
                    <input type="text" name="dev_id" class="form-control device_Id" required>
                  </div>
                  <div class="form-group">
                    <label>Assign User</label>
                    <?php 
                      $query = "SELECT * FROM user";
                      $result = mysqli_query($conn, $query);

                      if (mysqli_num_rows($result) > 0) {
                        ?>
                          <select name="dev_user" class="form-control">
                            <?php foreach ($result as $row) { ?>
                                 <option value="<?= $row['username'] ?>"><?= $row['username'] ?></option>
                            <?php } ?>
                          </select>
                        <?php
                      } 
                    ?>
                  </div>
                  <!-- <div class="form-group">
                    <label for="">Status</label>
                    <input type="checkbox" name="dev_status">Status
                  </div> -->
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