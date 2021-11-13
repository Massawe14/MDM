<?php

  include('authentication.php');
  
  include('includes/header.php');
  include('includes/adminTopbar.php');
  include('includes/adminSidebar.php');
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
              <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
              <li class="breadcrumb-item active">Main Sessions</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main Session Modal -->
    <div class="modal fade" id="AddSessionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Session</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="adminCode.php" method="POST" enctype="multipart/form-data">
          <div class="modal-body">
            <div class="form-group">
              <label for=""> Session ID </label>
              <input type="text" class="form-control" name="session_id" id="session_id" placeholder="Session ID" required/>
            </div>
            <div class="form-group">
              <label for=""> Session Name </label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Session Name" required/>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="addSession" class="btn btn-primary">Save</button>
          </div>
        </form>
      </div>
    </div>
    </div> 
  
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
                <h3 class="card-title">Main Sessions</h3>
                <a href="#" data-toggle="modal" data-target="#AddSessionModal" class="btn btn-primary btn-sm float-right">Add Session</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>SN</th>
                      <th>Session ID</th>
                      <th>Session Name</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Actions</th>
                      <!-- <th>Commands</th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $query = "SELECT * FROM main_sessions";
                      $result = mysqli_query($conn, $query); 

                      if (mysqli_num_rows($result) > 0) {
                        foreach ($result as $row) {
                          ?>
                            <tr>
                              <td><?php  echo $row['sn']; ?></td>
                              <td><?php  echo $row['session_id']; ?></td>
                              <td><?php  echo $row['name']; ?></td>
                              <td><?php  echo $row['start_time']; ?></td>
                              <td><?php  echo $row['end_time']; ?></td>
                              <td>
                                <form action="adminCode.php" method="POST">
                                  <a href="adminEditMainSession.php?sn=<?php echo $row['sn']; ?>" class="btn btn-info btn-sm">Edit</a>
                                  <input type="hidden" name="delete_mainsession_id" value="<?= $row['sn']; ?>">
                                  <button type="submit" name="deleteMainSessionUsers" class="btn btn-danger btn-sm">
                                   Delete
                                  </button>
                                </form>
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

    $('.deletesessionbtn').click(function (e) {
      e.preventDefault();
      var session_id = $(this).val();
      $('.delete_session_id').val(session_id);
      $('#DeleteSessionModal').modal('show');
    });

  });
</script>

<?php include('includes/footer.php'); ?>