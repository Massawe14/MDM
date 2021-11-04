<?php
  include('authentication.php');
  include('config/dbconn.php');
  
  include('includes/header.php');
  include('includes/topbar.php');
  include('includes/sidebar.php');
?>

<!-- Modal -->
<div class="modal fade" id="DeviceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Register Device</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

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
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="addDevice" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>

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
                Devices
                <a href="#" data-toggle="modal" data-target="#DeviceModal" class="btn btn-primary float-right">Add</a>
              </h4>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Device ID</th>
                    <th>Device User</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Location</th>
                    <th>Edit</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $query = "SELECT * FROM device";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                      foreach ($result as $row) {
                        ?>
                          <tr>
                            <td><?= $row['id']; ?></td>
                            <td><?= $row['dev_id']; ?></td>
                            <td><?= $row['dev_user']; ?></td>
                            <td><?= $row['dev_lat']; ?></td>
                            <td><?= $row['dev_long']; ?></td>
                            <td>
                              <?php 
                                if ($row['dev_status'] == "0") {
                                  echo "Not Active";
                                }
                                elseif ($row['dev_status'] == "1") {
                                  echo "Active";
                                }
                                else{
                                  echo "Invalid status";
                                }
                              ?>
                            </td>
                            <td><?= $row['created_at']; ?></td>
                            <td>
                              <a href="#" class="btn btn-info">View</a>
                            </td>
                            <td>
                              <a href="device-edit.php?id=<?= $row['id']; ?>" class="btn btn-success">Edit</a>
                            </td>
                            <td>
                              <form action="code.php" method="POST">
                                <input type="hidden" name="delete_dev_id" value="<?= $row['id']; ?>">
                                <button type="submit" name="deleteDevice" class="btn btn-danger">
                                  Delete
                                </button>
                              </form>
                            </td>
                          </tr>
                        <?php
                      }
                    }
                    else{
                      // echo "No Record Found";
                      ?>
                        <tr>
                          <td colspan="6">No Record Found</td>
                        </tr>
                      <?php
                    }
                  ?>
                </tbody>
              </table>
            </div> 
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include('includes/script.php'); ?>

<script>
  $(document).ready(function() {

    $('.device_id').keyup(function (e) {
      var deviceid = $('.device_id').val();

      $.ajax({
        type: "POST",
        url: "code.php",
        data: {
          'check_Devicebtn':1,
          'dev_id':deviceid,
        },
        success: function (response) {
          $('.device_error').text(response);
        }
      });

    });

  });
</script>

<?php include('includes/footer.php'); ?>