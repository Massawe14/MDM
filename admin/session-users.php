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
              <li class="breadcrumb-item active">Session Users</li>
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
                Session Users
              </h4>
            </div>
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Session ID</th>
                    <th>User ID</th>
                    <th>Device ID</th>
                    <th>Delete</th>
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
                            <td><?= $row['session_id']; ?></td>
                            <td><?= $row['user_id']; ?></td>
                            <td><?= $row['device_id']; ?></td>
                            <td>
                              <form action="code.php" method="POST">
                                <input type="hidden" name="delete_sessionusers_id" value="<?= $row['session_id']; ?>">
                                <button type="submit" name="deleteSessionUsers" class="btn btn-danger">
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
<?php include('includes/footer.php'); ?>