<?php
  include('authentication.php');
  include('config/dbconn.php');
  
  include('includes/header.php');
  include('includes/topbar.php');
  include('includes/sidebarDevice.php');
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
              <li class="breadcrumb-item active">Users Session</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main Session Modal -->
    <div class="modal fade" id="AddUserSessionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add User Session</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="code.php" method="POST" enctype="multipart/form-data">
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
              <label for="">User ID</label>
              <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User ID" required/>
            </div>
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
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="addUsersession" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
    </div>

  <section class="content mt-4">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php include('message.php'); ?>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Users Session</h3>
              <a href="#" data-toggle="modal" data-target="#AddUserSessionModal" class="btn btn-primary btn-sm float-right">Add User Session</a>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>SN</th>
                    <th>Session ID</th>
                    <th>User ID</th>
                    <th>Device ID</th>
                    <th>Actions</th>
                    <th>Commands</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    $query = "SELECT * FROM session_users";
                    $result = mysqli_query($conn, $query);

                    if (mysqli_num_rows($result) > 0) {
                      foreach ($result as $row) {
                        ?>
                          <tr>
                            <td><?= $row['sn']; ?></td>
                            <td><?= $row['session_id']; ?></td>
                            <td><?= $row['user_id']; ?></td>
                            <td><?= $row['device_id']; ?></td>
                            <td>
                              <form action="code.php" method="POST">
                                <a href="editUserSession.php?sn=<?php echo $row['sn']; ?>" class="btn btn-info btn-sm">Edit</a>
                                <input type="hidden" name="delete_sessionusers_id" value="<?= $row['sn']; ?>">
                                <button type="submit" name="deleteSessionUsers" class="btn btn-danger btn-sm">
                                  Delete
                                </button>
                              </form>
                            </td>
                            <td>
                              <button onclick="Restart(<?php echo $row['session_id']; ?>);" id="session_id" type="button" value="<?php echo $row['session_id']; ?>" class="btn btn-warning btn-sm">Restart</button>
                              <button onclick="TurnOff(<?php echo $row['session_id']; ?>);" id="session_id" type="button" value="<?php echo $row['session_id']; ?>" class="btn btn-danger btn-sm">Turn off</button>
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
  function Restart(session_id) {
    // var session_id = $("#session_id").val();
    console.log("Session ID :", session_id);
    var event = new CustomEvent("php-event", {detail: {channelId: "mdm-device-session", message: {sessionId: session_id, command: "RESTART"}}});
    window.dispatchEvent(event);
 }
</script>

<script>
  function TurnOff(session_id) {
    // var session_id = $("#session_id").val();
    console.log("Session ID :", session_id);
    var event = new CustomEvent("php-event", {detail: {channelId: "mdm-device-session", message: {sessionId: session_id, command: "TURN_OFF"}}});
    window.dispatchEvent(event);
  }
</script>

<?php include('includes/footer.php'); ?>