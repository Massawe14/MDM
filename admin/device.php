<?php

  include('authentication.php');
  
  include('includes/header.php');
  include('includes/topbar.php');
  include('includes/sidebar.php');
  include('config/dbconn.php');
  require_once('socket/socket_client.php');
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
              <li class="breadcrumb-item active">Registered Devices</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- User Modal -->
    <div class="modal fade" id="AddDeviceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Device</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
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
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="addDevice" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
    </div>

    <!-- Delete Admin -->
    <div class="modal fade" id="DeleteDeviceModal" tabindex="-1" aria-labelledby="exampleModalLabel"aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Device</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="code.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="delete_device" class="delete_device_id">
              <p>
                Are you sure. you want to delete this data ?
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="DeleteDevicebtn" class="btn btn-danger">Yes, Delete</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- Delete Admin -->  
  
    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <?php  
              if (isset($_SESSION['status'])) {
                echo "<h4>".$_SESSION['status']."</h4>";
                unset($_SESSION['status']);
              }
            ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Registered Device</h3>
                <a href="#" data-toggle="modal" data-target="#AddDeviceModal" class="btn btn-primary btn-sm float-right">Add Device</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>SN</th>
                      <th>Device ID</th>
                      <th>Device Name</th>
                      <th>Date Created</th>
                      <th>Battery Level</th>
                      <th>Battery Charging</th>
                      <!-- <th>Location Lat</th>
                      <th>Location Long</th> -->
                      <th>Last Used</th>
                      <th>Location</th>
                      <th>Actions</th>
                      <th>Commands</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $query = "SELECT * FROM devices";
                      $result = mysqli_query($conn, $query); 

                      if (mysqli_num_rows($result) > 0) {
                        foreach ($result as $row) {
                          ?>
                            <tr>
                              <td><?php  echo $row['sn']; ?></td>
                              <td><?php  echo $row['device_id']; ?></td>
                              <td><?php  echo $row['name']; ?></td>
                              <td><?php  echo $row['date_created']; ?></td>
                              <td><?php  echo $row['battery_level']; ?></td>
                              <td>
                                <?php 
                                  if ($row['battery_charging'] == "0") {
                                    echo "Not Charging";
                                  }
                                  elseif ($row['battery_charging'] == "1") {
                                    echo "Charging";
                                  }
                                  else{
                                    echo "Invalid status";
                                  }
                                ?>
                              </td>
                              <!-- <td><?php echo $row['location_lat']; ?></td>
                              <td><?php echo $row['location_lng']; ?></td> -->
                              <td><?php echo $row['last_used']; ?></td>
                              <td>
                                <form action="map.php" method="POST">
                                  <input type="hidden" name="display_map" value="<?= $row['device_id']; ?>">
                                  <button type="submit" name="displayMap" class="btn btn-success btn-sm">
                                    View
                                  </button>
                                </form>
                              </td>
                              <td>
                                <a href="device-edit.php?sn=<?php echo $row['sn']; ?>" class="btn btn-info btn-sm">Edit</a>
                                <button type="button" value="<?php echo $row['sn']; ?>" class="btn btn-danger btn-sm deletedevicebtn">Delete</button>
                              </td>
                              <td>
                                <button onclick="Restart();" id="device_id" type="button" value="<?php echo $row['device_id']; ?>" class="btn btn-warning btn-sm">Restart</button>
                                <button onclick="TurnOff();" id="device_id" type="button" value="<?php echo $row['device_id']; ?>" class="btn btn-danger btn-sm">Turn off</button>
                              </td>
                            </tr>
                          <?php
                        }
                      }
                      else{
                        ?>
                          <tr>
                            <td>No Record Found</td>
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
  $(document).ready(function () {

    $('.deletedevicebtn').click(function (e) {
      e.preventDefault();
      var device_id = $(this).val();
      $('.delete_device_id').val(device_id);
      $('#DeleteDeviceModal').modal('show');
    });

  });
</script>

<script>
  function Restart() {
    var device_id = $("#device_id").val();
    console.log("Device ID :", device_id);
    var event = new CustomEvent("php-event", {detail: {channelId: "mdm-device-message", message: {deviceId: device_id, command: "RESTART"}}});
    window.dispatchEvent(event);
}
</script>

<script>
  function TurnOff() {
    var device_id = $("#device_id").val();
    console.log("Device ID :", device_id);
    var event = new CustomEvent("php-event", {detail: {channelId: "mdm-device-message", message: {deviceId: device_id, command: "TURN_OFF"}}});
    window.dispatchEvent(event);
}
</script>

<script>
  function TurnOff() {
    var device_id = $("#device_id").val();
    console.log("Device ID :", device_id);
    var event = new CustomEvent("php-event", {detail: {channelId: "mdm-device-all", message: {deviceId: device_id, command: "TURN_OFF"}}});
    window.dispatchEvent(event);
}
</script>

<?php include('includes/footer.php'); ?>